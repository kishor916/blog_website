<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','body','user_id',];

    public function momo(){
        return $this->belongsTo(User::class,'user_id');//representing relationship whith the User class using user_id.
    }
}
