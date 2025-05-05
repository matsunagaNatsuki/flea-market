<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Condition extends Model
{
    protected $fillable = ['condition_name'];

    public function sells(): HasMany
    {
        return $this->hasMany(Sell::class, 'condition_id');
    }
}
