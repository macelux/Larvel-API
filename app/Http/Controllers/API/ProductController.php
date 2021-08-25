<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Validator;


class ProductController 
{
    
    public function show()
    {
        return   ProductResource::collection(Product::paginate());
    }

}
