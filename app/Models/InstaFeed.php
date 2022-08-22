<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstaFeed extends Model
{
    use HasFactory;
    public $table='intsa_feeds';
    protected $fillable=['title','layout','spacing','click', 'border','column','load_more'];
}
