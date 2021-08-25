<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
     protected $fillable = [
        'order_number', 'customer_id', 'status', 'grand_total', 'item_count', 'payment_status', 'payment_method' , 'address', 'city', 'country', 'post_code','phone_number'
    ];
    public function user()
    {
    	return $this->belongsTo(User::class , 'customer_id');
    }
    public function items()
    {
    	 return $this->hasMany(OrderItem::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class , 'order_items' ,'order_id' , 'product_id');
    }

}
