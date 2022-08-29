<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstaStory extends Model
{
    use HasFactory;
    public $table='insta_stories';
    protected $fillable=['title','click', 'story'];

}
