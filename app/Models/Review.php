<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',	'product_id','body'
    ];
    public function user()
    {
        return $this->belongsTo(User::class , 'customer_id');
    }
    public function product()
    {
        return $this->belongsToMany(Product::class);
    }

}
