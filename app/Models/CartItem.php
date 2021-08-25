<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
//    use SoftDeletes;
    use HasFactory;
    protected $primaryKey = 'Id';
    protected $table = 'cart_items';
    protected $fillable = [
        'Id' ,'customer_id ',  'product_id', 'quantity' , 'deleted_at','cart_id'
    ];
    protected $hidden = [
        'Price'
    ];
    public function user()
    {
        return $this->belongsTo(User::class , 'customer_id');
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class , 'cart_cart_item' , 'cart_item_id' , 'cart_id');

    }

}
