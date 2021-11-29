<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Difficulty;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'numOfPeople', 'cookTime', 'ingredients', 'instructions', 'image', 'user_id', 'difficultyName'
    ];
}
