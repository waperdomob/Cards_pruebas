<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function user()
     {
        return $this->hasMany(User::class,'game_id');
    }
    
    public function card()
     {
        return $this->hasMany(Card::class,'game_id');
    }
}
