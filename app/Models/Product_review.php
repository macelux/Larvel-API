<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_review extends Model
{
    use HasFactory;
    protected $table = 'product_review';
    protected $fillable = [
        'product_id' , 'review_id'
    ];

}
