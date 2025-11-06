<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
