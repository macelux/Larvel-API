<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Admin;
use App\Http\Resources\OrderResource;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Notifications\OrderPlaced;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;


class OrderController extends Controller
{
    public function show($id)
    {
        $order = Order::findorfail($id);
        if(auth()->user()->id == $order->customer_id)
            return  new OrderResource($order);
        else
            return response(['message' => 'you can only view your own order'] , 401);
    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            '*.product_id' => 'exists:products,id',
            '*.quantity' => 'numeric|required',
        ]);
        if($validator->fails())
       {
           return response(['message' => $validator->errors()]);
       }
       return $collection = collect($request);

//
//        $validator = Validator::make($request->all(), [
//            'product_id' => 'required',
//            'quantity' => 'required',
//        ]);
//       if($validator->fails())
//       {
//           return response(['message' => $validator->errors()]);
//       }
//$val =      $request->toArray();
//        for($i = 0; $i<count($val); $i++)
//        {
//            return $request[$i];
//        }
//
//        return $request;
//        $collection = collect($request);
//        foreach ($collection)
//
//        return $collection->count();
//        return $collection;
//        $collection->each(function($item){
//            return $item *2;
//       });
//       return $val;
//        return $collection[1];
//        for($i = 0; $i<count($collection); $i++)
//        {
//            return $collection[$i];
//        }
//
//
//            $validator = Validator::make($value, [
//                'product_id' => 'required',
//                'quantity' => 'required',
//            ]);
//            if($validator->fails())
//                return response(['message' => $validator->errors()]);
//
//        });
//        return $collection;
//
//
//        $request->headers->set('Accept' , 'application/json');
//        $filtered = $collection->validate(['product_id' => 'required']);
//        return $filtered;
//        $filtered = $collection->filter(function($value){
//            Validator::make(($value) , [
//               'email' => 'required',
//                'quantity' => 'required'
//            ]);
//
//        });
//
//
//        $params = $request->except('_token');
//        $Order = Order::create($params);
//        $Admins = Admin::all();
//        Notification::send($Admins , new OrderPlaced($Order));
////            $Admin->notify(new OrderPlaced($Order));
//
//        return  new OrderResource($Order);

    }



    public function update(UpdateOrderRequest $request , $id)
    {
        $Order = Order::findorfail($id);
        if(auth()->user()->id  == $Order->customer_id)
        {
            $params = $request->except('_token' , 'status' , 'total' , 'item_count' , 'payment_status');
            $Order ->update($params);
            return  new OrderResource($Order);
        }
        else
        {
            return response(['message' => 'you can only modify your own order'] , 401);
        }


    }
    public function destroy($id)
    {
        $Order = Order::findorfail($id);
        if(auth()->user()->id  == $Order->customer_id)
        {
            $Order->delete();
            return  new OrderResource($Order);
        }
        else
        {
            return response(['message' => 'you can only delete your own order'] , 401);
        }

    }
}
