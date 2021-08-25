@extends('adminlte::page')
@section('title') {{ 'Edit Order' }} @endsection
@section('styles')
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('backend/js/plugins/dropzone/dist/min/dropzone.min.css') }}"/> -->
     <link rel="stylesheet" href="/css/admin_custom.css">
@endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-shopping-bag"></i> {{ 'Edit Order' }} </h1>
        </div>
    </div>

    <div class="col-md-9">
        <div class="tab-content">
            <div class="tab-pane active" id="general">
                <div class="tile">
                    <form action="{{ route('admin.orders.update') }}" method="POST" role="form">
                        @csrf
                        <h3 class="tile-title">Order Information</h3>
                        <hr>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="status">	Status</label>
                                    <input
                                            class="form-control @error('status') is-invalid @enderror"
                                            type="text"
                                            placeholder="Enter order Status"
                                            id="status"
                                            name="status"
                                            value="{{ old('status', $order->status) }}"
                                    />
                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('status') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="grand_total">	GrandTotal</label>
                                    <input
                                            class="form-control @error('grand_total') is-invalid @enderror"
                                            type="text"
                                            placeholder="Enter order GrandTotal"
                                            id="grand_total"
                                            name="grand_total"
                                            value="{{ old('grand_total', $order->grand_total) }}"
                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('grand_total') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="item_count">	ItemCount </label>
                                    <input
                                            class="form-control @error('item_count') is-invalid @enderror"
                                            type="text"
                                            placeholder="Enter order ItemCount"
                                            id="item_count"
                                            name="item_count"
                                            value="{{ old('item_count', $order->item_count) }}"                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('item_count') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="payment_status">	PaymentStatus</label>
                                    <input
                                            class="form-control @error('payment_status') is-invalid @enderror"
                                            type="text"
                                            placeholder="Enter order PaymentStatus"
                                            id="payment_status"
                                            name="payment_status"
                                            value="{{ old('payment_status', $order->payment_status)}}"
                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('payment_status') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>



                        <div class="tile-footer">
                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right">
                                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Order</button>
                                    <a class="btn btn-danger" href="{{ route('orders.index') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Go Back</a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>




@endsection
