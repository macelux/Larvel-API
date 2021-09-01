<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
//use App\Traits\HasCompositePrimaryKeyTrait;


class CartProduct extends Model
{
    use HasFactory;
    public $timestamps = false;



    protected $table = 'cart_product';

    protected $fillable = [
        'cart_id' , 'product_id' , 'quantity' ,'Price'
    ];
    protected $hidden = [

    ];
    protected $guarded = [

    ];







}
