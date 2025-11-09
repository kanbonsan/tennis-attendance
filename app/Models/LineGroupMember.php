<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $line_group_id
 * @property string $user_id
 * @property string|null $display_name
 * @property string|null $last_seen_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\LineGroup|null $group
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroupMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroupMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroupMember query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroupMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroupMember whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroupMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroupMember whereLastSeenAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroupMember whereLineGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroupMember whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroupMember whereUserId($value)
 * @mixin \Eloquent
 */
class LineGroupMember extends Model
{
    protected $fillable = [
        'line_group_id',
        'user_id',
        'display_name',
        'last_seen_at',
    ];

    public function group()
    {
        return $this->belongsTo(LineGroup::class, 'line_group_id', 'line_group_id');
    }
}
