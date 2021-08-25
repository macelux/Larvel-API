<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory;
//    use SoftDeletes;
    protected $table = 'carts';
    protected $fillable = [
        'id' ,  'customer_id ',  'product_id', 'quantity' , 'Price'
    ];
    protected $hidden = [

    ];
    public function cart_items()
    {
        return $this->belongsToMany(CartItem::class , 'cart_cart_item' , 'cart_id' , 'cart_item_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class , 'product_id');
    }
}
