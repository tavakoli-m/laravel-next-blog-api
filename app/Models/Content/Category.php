<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\Content\CategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name'
    ];
}
