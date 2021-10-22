<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    use HasFactory;
    protected $table='bugs';
    protected $primarykey='id';

    protected $fillable =[
        'bug'
         ];

    public function card()
     {
        return $this->hasMany(Card::class,'bug_id');
    }
}
