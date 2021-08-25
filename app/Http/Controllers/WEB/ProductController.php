<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\RedirectResponse;
use App\Providers\Created;

class ProductController 
{
    
    public function index()
    {

        $products = Product::all();
        for($i  = 0 ; $i < count($products) ; $i++)
        {
            $products[$i]->count = $i + 1;
        }

        return view('pages.products' , compact('products'));


    }
    public function create()
    {
      return view('admin.products.create');
    }

    public function store(StoreProductRequest $request)
    {
//        return "cool";
        $params = $request->except('_token');

        $product = Product::create($params);
        $product->save();
        session()->flash("message" , "Product added Sucessfully");
        return redirect()->route('products.index');

//        dd("")


//        event(new Created($product));



    }


    public function edit($id)
    { 
        $product = Product::findorfail($id);
      

      
        return view('admin.products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request)
    {
      
      $params = $request->except('_token');
      
      $product = Product::findorfail($request->product_id);
      $product->update($params);
        session()->flash("message" , "Product updated Sucessfully");

        return redirect()->route('products.index');

    }
    public function destroy($id)
    {
        
        $product = Product::findorfail($id);
        $product->delete();
        session()->flash("message" , "Product deleted Sucessfully");
        return redirect()->route('products.index');
    }
}