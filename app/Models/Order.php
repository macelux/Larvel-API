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

    public function getPaymentStatusAttribute()
    {
        $val = ($this->attributes['payment_status'] == 1?"paid":"not paid");
        return $val;

    }
    public function setPaymentStatusAttribute($value)
    {
//        $value = ("paid"?1:0);
//        $this->
        $this->attributes['payment_status'] = ($value=="paid"?1:0);
    }
//    protected $casts = [
//        'payment_status' => 'boolean',
//    ];
}
