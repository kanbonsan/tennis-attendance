<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $line_group_id
 * @property string $type
 * @property string|null $name
 * @property string|null $picture_url
 * @property int|null $member_count
 * @property string|null $joined_at
 * @property string|null $left_at
 * @property string|null $last_synced_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LineGroupMember> $members
 * @property-read int|null $members_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroup whereJoinedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroup whereLastSyncedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroup whereLeftAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroup whereLineGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroup whereMemberCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroup wherePictureUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroup whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LineGroup whereUpdatedAt($value)
 */
	class LineGroup extends \Eloquent {}
}

namespace App\Models{
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
 */
	class LineGroupMember extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

