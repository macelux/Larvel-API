<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\CartProduct;
use App\Notifications\OrderPlaced;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItem;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function placeOrder( Request $request)
    {
        $params = $request->except('_token');
        $validator = Validator::make($params , [
            "address" => "string|required",
            'city'  => "string|required" ,
            'country' => "string|required",
            'post_code'=>"string|required",
            'phone_number'=>"string|required",
            'cart_id'=>"exists:carts,id|required"


        ]);
        if($validator->fails())
        {
            return response(['message' => $validator->errors()]);
        }
        $cart = Cart::find($request->cart_id);

        $gTotal = 0;
        $itCount = 0;

       $cartitems =  collect(CartProduct::where('cart_id' , $request->cart_id)->get());

        foreach ($cartitems as $item)
        {
            $gTotal +=$item->Price;
            $itCount += $item->quantity;
        }
        $order = Order::create([
            'order_number'      =>  'ORD-'.strtoupper(uniqid()),
            'customer_id'           => auth()->user()->id,
            'status'            =>  'pending',
            'grand_total'       =>  $gTotal,
            'item_count'        =>  $itCount,
            'payment_status'    =>  0,
            'payment_method'    =>  null,
            'address'           =>  $params['address'],
            'city'              =>  $params['city'],
            'country'           =>  $params['country'],
            'post_code'         =>  $params['post_code'],
            'phone_number'      =>  $params['phone_number'],

        ]);


        if ($order)
        {

            $items = collect(CartProduct::where('cart_id', $params['cart_id'])->get());

            foreach ($items as $item)
            {

                $product = Product::where('id', $item->product_id)->first();
                $orderItem = new OrderItem([
                    'order_id' => $order->id,
                    'product_id'    =>  $product->id,
                    'quantity'      =>  $item->quantity,
                    'price'         =>  $item->Price,
                ]);

                $orderItem->save();
            }
            $cart->delete();
            Notification::send(Admin::all() , new OrderPlaced($order));
            return new OrderResource($order);

        }






    }
}
