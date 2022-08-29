<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstaReel extends Model
{
    use HasFactory;
    public $table='insta_reels';
    protected $fillable=['title','click','reel'];

}
