<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    public function user(){
        return $this -> belongsTo(User::class, 'user_id');
    }
    public function category(){
        return $this -> belongsTo(Category::class, 'category_id');
    }
    public function bug(){
        return $this -> belongsTo(Bug::class, 'bug_id');
    }
    public function game(){
        return $this -> belongsTo(Game::class, 'game_id');
    }
}
