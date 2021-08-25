

@extends('adminlte::page')

@section('title', 'Orders')

@section('content_header')
    <h1>Orders</h1>
@stop

@section('content')
    @if(session()->has('message'))


        <div class="alert alert-success bg-green">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{session('message')}}
        </div>
    @endif

    <div class="classes_content">




        <table class="table table-bordered ">
            <tr>
                <td> S/N  </td>
                <td> Customer</td>
                <td> 	Status </td>
                <td> 	Grand Total  </td>

                <td> Item Count</td>
                <td> Payment Status </td>

                <td> Payment Method</td>
                <td> Actions</td>






            </tr>
            @foreach($Orders as $order)

                <tr>
                    <td>{{$order->count}}</td>

                    <td>{{$order->user->fullname}} </td>
                    <td>{{$order->status}}</td>
                    <td>{{$order->grand_total}}</td>

                    <td>{{$order->item_count}}</td>
                    <td>{{$order->payment_status==1?"paid":"not paid"}}</td>
                    <td>{{$order->payment_method}}</td>
                    <td>
                        <a class="btn btn-xs btn-default text-primary mx-1 shadow btn-inline" title="Edit " href = "{{route('admin.orders.edit', $order->id )}}">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>

                        <a class="btn btn-xs btn-default text-primary mx-1 shadow btn-inline" title="Edit " href = "{{route('admin.orders.show', $order->id )}}">
                            <i class="fa fa-lg fa-fw fa-eye"></i>
                        </a>
                        <a class="btn btn-xs btn-default text-danger mx-1 shadow btn-inline" title="Delete" href = "{{route('admin.orders.delete', $order->id )}}">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </a>
                    </td>









                </tr>
            @endforeach
        </table>
    </div>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop