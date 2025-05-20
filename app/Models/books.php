<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class books extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $fillable = [
        'id',
        'title',
        'author',
        'genre',
    ];
}
