<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    protected $table = "likes";

    protected $fillable = [
        'base_user', 'target_user', 'base_user_like', 'target_user_like'
    ];


}
