<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coments extends Model
{
    use HasFactory;

    protected $fillable = [
        'coment',
        'user_id',
        'posts_id',
    ];
}
