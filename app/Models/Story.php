<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;
    protected $fillable = [
       
        'title',
        'display_page',
        'color_type',
        'first_color',
        'second_color',
        'angle',
       
    ];

    public function images()
    {
        return $this->hasMany(StoriesImages::class, 'story_id');
    }
}
