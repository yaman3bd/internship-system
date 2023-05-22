<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'parent_id',
        'data',
        'messageable',
        'read_at'
    ];
    protected $casts = [
        'data' => 'array',
    ];

    public function replies()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function messageable()
    {
        return $this->morphTo();
    }
}
