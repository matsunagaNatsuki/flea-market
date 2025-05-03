<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;

    protected $fillable =['name', 'price', 'description', 'image', 'condition_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function conditions()
    {
        return $this->belongsTo(Condition::class);
    }
}
