<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoriesImages extends Model
{
    use HasFactory;
    protected $fillable = [
        'image_title',
        'image_path',
        'image_link',
        'story_id',
    ];
}
