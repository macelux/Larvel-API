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
use App\Models\CartProduct;


class CartController extends Controller
{

    public function createCart()
    {
        $cart = Cart::create();
        $cart->customer_id = auth()->user()->id;
        $cart->save();
        return response(["cart_id" => $cart->id]);
    }

    public function addToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "cart_id" => "exists:carts,id|required",
            "product_id" => "exists:products,id|required",
            'quantity' => 'numeric|required',

        ]);
        if ($validator->fails()) {
            return response([$validator->errors()]);
        }
        $product = Product::find($request->product_id);
        if ($request->quantity > $product->quantity) {

            return response(["message" => "You can only order {$product->quantity} units of this product"]);
        }

        $cart = Cart::find($request->cart_id);

        $product->quantity = $product->quantity - $request->quantity;
        $product->save();

        if ($cart->products->contains($product)) {
            $cartitem = CartProduct::where([['cart_id', $request->cart_id], ['product_id', $request->product_id]])->first();
            DB::table('cart_product')
                ->where([['cart_id', $request->cart_id], ['product_id', $request->product_id]])
                ->update(['quantity' => $cartitem->quantity + $request->quantity, 'Price' => $cartitem->Price + ($product->price * $request->quantity)]);
            return new CartItemResource(CartProduct::where([['cart_id', $request->cart_id], ['product_id', $request->product_id]])->first());
        } else {
            $cartitem = CartProduct::create([
                'cart_id' => $request->cart_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'Price' => $product->price * $request->quantity
            ]);
            $cartitem->save();
            return new CartItemResource($cartitem);
        }


    }

    public function getCart($id)
    {
        $cart = Cart::find($id);
        if ($cart->customer_id == auth()->user()->id) {
            $cartitems = CartProduct::where('cart_id', $id)->get();
            return collect($cartitems);

        }

    }

    public function removeItem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "cart_id" => "exists:carts,id|required",
            "product_id" => "exists:products,id|required",
        ]);
        if ($validator->fails()) {
            return response([$validator->errors()]);
        }

        $product = Product::find($request->product_id);
        $cartitem = CartProduct::where([['cart_id', $request->cart_id], ['product_id', $request->product_id]])->first();
        $product->quantity = $product->quantity + $cartitem->quantity;
        $product->save();
        DB::table('cart_product')->
        where([['cart_id', $request->cart_id], ['product_id', $request->product_id]])->delete();

        return response(["message" => 'item succesfully  removed']);
    }

    public function clearCart($id)
    {
        CartProduct::where('cart_id', $id)->delete();
        return response(["message" => 'Cart succesfully  cleared']);
    }
}
