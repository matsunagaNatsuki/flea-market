<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Profile extends Model
{

    protected $fillable = ['user_id', 'image', 'postal_code', 'address', 'building',];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withTimestamps();
    }
}