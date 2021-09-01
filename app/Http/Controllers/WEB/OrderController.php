<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $Orders = Order::with('user')->get();
        for($i  = 0 ; $i < count($Orders) ; $i++)
        {
            $Orders[$i]->count = $i + 1;

        }


        return view('pages.orders' , compact('Orders'));
    }
    public function show($id)
    {
        $order = Order::find($id);






        return view('admin.orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order= Order::findorfail($id);

        return view('admin.orders.edit', compact('order'));
    }

    public function update(UpdateOrderRequest $request)
    {


        $params = $request->except('_token');

        $order= Order::findorfail($request->order_id);
        $order->update($params);
        $order->save();
        session()->flash("message" , "Order updated Sucessfully");
        return redirect()->route('orders.index');

    }
    public function destroy($id)
    {

        $order= Order::findorfail($id);
        $order->delete();

        session()->flash("message" , "Order deleted Sucessfully");

        return redirect()->route('orders.index');
    }

}
