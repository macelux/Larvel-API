<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartCartItem extends Model
{
//    use SoftDeletes;
    use HasFactory;
    protected $table = 'cart_cart_item';
    protected $fillable = [
        'cart_id' , 'cart_item_id'
    ];
    protected $hidden = [

    ];

}
