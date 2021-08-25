<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CartItem;
use App\Models\Product;
use App\Http\Resources\CartItemResource;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use App\Models\CartCartItem;
use Carbon\Carbon;
use App\Http\Resources\CartResource;


class CartController extends Controller
{

    public function createCart()
    {
        $cart = Cart::create();
        $count = count(Cart::all());
        $cart->id = $count + 1;
        $cart->customer_id = auth()->user()->id;
        $cart->save();
     return response(["cart_id" => $cart->id]);
    }

    public function addToCart(Request $request)
    {

        $params = $request->except('_token');
        $validator = Validator::make($request->all() , [
            "cart_id" => "exists:carts,id|required",
            "product_id" => "exists:products,id|required",
            'quantity' =>'numeric|required',

        ]);
        if($validator->fails())
        {
            return response([ $validator->errors()]);
        }
        $product = Product::find($request->product_id);

        if($request->quantity > $product->quantity)
        {

            return response(["message" => "You can only order {$product->quantity} units of this product"]);
        }
        $cart = Cart::find($request->cart_id);
        $product->quantity = $product->quantity - $request->quantity;
        $product->save();
        if(!$cart->product_id)
        {
            $cart->product_id = $request->product_id;
            $cart->quantity = $request->quantity;
            $cart->Price = $product->price * $request->quantity;
            $cart->save();
            return new CartResource($cart);

        }
        if($cart->product_id == $request->product_id)
        {
            $cart->quantity = $cart->quantity +  $request->quantity;
            $cart->Price = $cart->Price + ($product->price * $request->quantity);
            $cart->save();
            return new CartResource($cart);
        }

        else
        {
            $cart = Cart::create([

                'product_id'  => $request->product_id,
                'quantity' => $request->quantity,
                'Price'=>$product->price * $request->quantity,
            ]);
            $cart->id = $request->cart_id;
            $cart->customer_id = auth()->user()->id;
            $cart->save();
            return new CartResource($cart);
        }


//

//        return new CartResource($cart);


//        $cartitem =  CartItem::create($params);
//        $cartitem->Price = $product->price * $request->quantity;
//        $cartitem->save();


//        CartCartItem::create([
//            'cart_id' => $request->cart_id,
//            'cart_item_id' =>  $cartitem->Id,
//        ]);
//        return new CartItemResource($cartitem);
    }
    public function getCart($id)
    {

        $cart = Cart::where('id' , $id)->get();
        return $cart->products;
        return $cart;
//        collect($cart)->each(fn($item)=>new CartResource($item));




////        if(!$cart)
////            return response(["message" =>'The id is invalid']);
////        foreach ($cart->products as $product)
////        {
////            return response(["data" => [""] ])
////        }

    }

    public function removeItem(Request $request , $id)
    {
        $validator = Validator::make($request->all() , [
            "cart_id" => "exists:carts,id|required"
        ]);
        if($validator->fails())
        {
            return response(['message' => $validator->errors()]);
        }
        $cart = Cart::find($request->cart_id);
        $cartitem = CartItem::findorfail($id);
        if(!$cartitem)
            return response(["message" =>'The cart item id is invalid']);
        $item =  $cart->cart_items->only($cartitem->Id);
        foreach($item as $it)
            $product = Product::find($cartitem->product_id);
            $it->delete();
            $product->quantity = $product->quantity + $cartitem->quantity;
            $product->save();

        return response(["message" =>'item succesfully  removed']);
    }
    public function clearCart($id)
    {
        $cart = Cart::find($id);
        if(!$cart)
            return response(["message" =>'The id is invalid']);


        foreach($cart->cart_items as $item)
        {
            $item->delete();
            $product = Product::find($item->product_id);
            $product->quantity = $product->quantity + $item->quantity;
            $product->save();


        }
        return response(["message" =>'Cart succesfully  cleared']);
    }
}
