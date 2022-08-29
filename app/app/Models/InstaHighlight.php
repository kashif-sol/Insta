<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstaHighlight extends Model
{
    use HasFactory;
    public $table='insta_highlights';
    protected $fillable=['title','click','highlight'];
}
