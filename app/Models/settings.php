<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class settings extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'display_device',
        'custom_css',
        'custom_js',
        'shop_id',
    ];
}