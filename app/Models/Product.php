<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory; // Use HasFactory for factories

    // Specify the fillable attributes
    protected $fillable = ['name', 'description', 'price', 'image_path'];
}
