<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Cart;
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



        for($i = 0 ; $i < count($cart->cart_items); $i++)
        {
            $gTotal += $cart->cart_items[$i]->Price;
            $itCount += $cart->cart_items[$i]->quantity;
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
        $order->save();

        if ($order)
        {

            $items = $cart->cart_items;

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
            foreach($cart->cart_items as $item)
            {
                $item->delete();
                $item->pivot->deleted_at = Carbon::now();
                $item->pivot->save();
            }

            $cart->delete();
            return new OrderResource($order);
        }






    }
}
