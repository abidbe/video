<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class VideoRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'video_id',
        'requested_at',
        'approved_at',
        'expires_at',
    ];

    protected $dates = [
        'requested_at',
        'approved_at',
        'expires_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
