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
        'id' ,  'customer_id ',
    ];
    protected $hidden = [

    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity' , 'Price');
    }
}
