<?php
// ChatGPT によって作成されたもの
// Line Group メンバーの同期処理

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\LineGroupMember;

class LineGroupSyncService
{
    private string $token;

    public function __construct()
    {
        $this->token = (string) config('services.line.channel_access_token');
        if (!$this->token) {
            throw new \RuntimeException('LINE channel access token missing');
        }
    }

    /**
     * グループの memberIds を全取得して line_group_members に upsert
     * displayName 取得は任意（レート上限に注意）
     */
    public function syncMembers(string $groupId, bool $withProfiles = false): int
    {
        $insertedOrUpdated = 0;
        $start = null;

        do {
            $res = $this->callWithRetry("https://api.line.me/v2/bot/group/{$groupId}/members/ids", $start ? ['start' => $start] : []);
            $json = $res->json();
            $ids  = (array) ($json['memberIds'] ?? []);

            // upsert
            foreach ($ids as $uid) {

                LineGroupMember::updateOrCreate();
                DB::table('line_group_members')->updateOrInsert(
                    ['line_group_id' => $groupId, 'user_id' => $uid],
                    ['last_seen_at' => now(), 'updated_at' => now(), 'created_at' => now()]
                );
                $insertedOrUpdated++;

                if ($withProfiles) {
                    $profile = $this->fetchProfile($uid);
                    if ($profile) {
                        DB::table('line_group_members')->where([
                            'line_group_id' => $groupId,
                            'user_id'       => $uid,
                        ])->update([
                            'display_name' => $profile['displayName'] ?? null,
                            'updated_at'   => now(),
                        ]);
                    }
                }
            }

            $start = $json['next'] ?? null;
        } while ($start);

        // メンバー数を反映
        try {
            $countRes = $this->callWithRetry("https://api.line.me/v2/bot/group/{$groupId}/members/count");
            $countJson = $countRes->json();
            $memberCount = $countJson['count'] ?? null;
        } catch (\Throwable $e) {
            $memberCount = null;
        }

        DB::table('line_groups')->where('line_group_id', $groupId)->update([
            'member_count'   => $memberCount,
            'last_synced_at' => now(),
            'updated_at'     => now(),
        ]);

        return $insertedOrUpdated;
    }

    private function fetchProfile(string $userId): ?array
    {
        try {
            $res = $this->callWithRetry("https://api.line.me/v2/bot/profile/{$userId}");
            return $res->successful() ? $res->json() : null;
        } catch (\Throwable $e) {
            Log::warning('profile fetch failed', ['userId' => $userId, 'err' => $e->getMessage()]);
            return null;
        }
    }

    private function callWithRetry(string $url, array $query = [], string $method = 'GET')
    {
        $tries = 0;
        $wait  = 500; // ms
        while (true) {
            $tries++;

            // リクエストのAuthorizationヘッダにBearerトークンをすばやく追加したい場合は、withTokenメソッドを使用できます。
            // ->retry(0,0) で「再試行しない」という意味
            $res = Http::withToken($this->token)->retry(0, 0)->withQueryParameters($query)->{$method}($url);

            // 429 -- 大量のリクエストによるエラー
            if ($res->status() !== 429 && $res->status() < 500) {
                return $res;
            }

            // 429 or 5xx → リトライ
            // Retry-After レスポンス HTTP ヘッダーは、ユーザーエージェントがフォローアップリクエストを行う前にどれくらい待つべきかを示します(秒)。
            $retryAfter = (int) $res->header('Retry-After', 0);
            usleep(max($wait * 1000, $retryAfter * 1_000_000));
            $wait = min($wait * 2, 4000);   // 次は wait 時間を倍に

            if ($tries >= 5) {
                $res->throw(); // もう無理
            }
        }
    }
}
