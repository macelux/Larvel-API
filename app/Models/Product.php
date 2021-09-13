<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Product extends Model
{
    use HasFactory;
     protected $table = 'products';

    /**
     * @var array
     */
    protected $fillable = [
        'id' , 'sku', 'name', 'slug', 'description', 'quantity',
        'weight', 'price', 'sale_price', 'status', 'featured','created_at' , 'updated_at' 
    ];

    /**
     * @var array
     */
    protected $casts = [
        'quantity'  =>  'integer',
       
        'status'    =>  'boolean',
        'featured'  =>  'boolean'
    ];

    /**
     * @param $value
     */
     public function setNameAttribute($value)
     {
     	$this ->attributes['name'] = $value;
     	$this->attributes['slug'] = Str::slug($value);
     }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class , 'order_items' , 'order_id' , 'product_id');
    }
    public function cart()
    {
        return $this->belongsToMany(Cart::class)->withPivot('quantity' , 'Price');
    }

     
}
