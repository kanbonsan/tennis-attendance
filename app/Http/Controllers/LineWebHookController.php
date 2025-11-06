<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\LineGroup;
use App\Models\LineGroupMember;

class LineWebHookController extends Controller
{
    public function handle(Request $request)
    {

        if ($request->isMethod('get')) {
            return response("OK", 200);
        }

        // 署名検証
        $channelSecret = config('services.line.channel_secret');
        $signature = $request->header('X-Line-Signature');
        $hash = base64_encode(hash_hmac('sha256', $request->getContent(), $channelSecret, true));

        if (!hash_equals($hash, $signature)) {
            Log::warning('LINE signature mismatch');
            return response('signature mismatch', 403);
        }

        $payload = $request->json()->all();
        foreach ($payload['events'] ?? [] as $e) {

            $source = $e['source'];
            if (($source['type'] ?? '') !== 'group') {
                continue;
            }

            $groupId = $source['groupId'] ?? null;
            if (!$groupId) continue;

            // 以上 グループ以外は対象外で除外

            switch ($e['type'] ?? '') {
                case 'join':
                    $group = LineGroup::updateOrCreate(
                        ['line_group_id' => $groupId],
                        ['type' => 'group', 'joined_at' => now(), 'left_at' => null]
                    );
                    // summary で name/picture を更新
                    try {
                        $token = config('services.line.channel_access_token');
                        if ($token) {
                            // Bearer Tokenを Authorizationヘッダーに追加
                            $sum = Http::withToken($token)->get("https://api.line.me/v2/bot/group/{$groupId}/summary")
                                ->json();
                            $group->fill([
                                'name' => $sum['groupName'] ?? $group->name,
                                'picture_url' => $sum['pictureUrl'] ?? $group->picture_url,
                            ])->save();
                        }
                    } catch (\Throwable $err) {
                        Log::warning('summary fetch failed', ['gid' => $groupId, 'err' => $err->getMessage()]);
                    }
                    break;
                case 'leave':
                    LineGroup::where('line_group_id', $groupId)->update(['left_at' => now()]);
                    break;
                case 'message':
                    $userId = $source['userId'] ?? null;
                    if ($userId) {
                        LineGroupMember::updateOrCreate(
                            ['line_group_id' => $groupId, 'user_id' => $userId],
                            ['last_seen_at' => now()]
                        );
                    }
                    break;
            }
        }
        return response('OK', 200);
    }
}
