<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineGroup extends Model
{
    protected $fillable = [
        'line_group_id',
        'type',
        'name',
        'picture_url',
        'member_count',
        'joined_at',
        'left_at',
    ];

    public function members()
    {
        return $this->hasMany(LineGroupMember::class, 'line_group_id', 'line_group_id');
    }
}
