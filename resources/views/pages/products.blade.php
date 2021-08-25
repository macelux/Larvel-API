<!-- 
<?php use Illuminate\Support\Facades\DB; ?> -->

@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
    <h1>products</h1>
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
		
  <a href = "{{route('admin.products.create')}}" class="btn btn-primary pull-right float-right mb-3">Add Product</a>





	<table class="table table-bordered "> 
 	<tr> 
 		<td> S/N  </td>
 		<td> Sku</td>
 		<td> Name </td>
 		<td> Slug  </td>
 		<td> Description</td>
 		<td> Quantity </td>
 		<td> Weight </td>
 		<td> Price</td>
 		<td> Saleprice </td>
 		<td> Status  </td>

 		<!-- @can('admins') -->
 		@auth('admin')
 			<td>Actions</td>
 		<!-- @endcan	 -->
 		@endauth
 		  			


 	</tr>

 	@foreach($products as $product)

	 	<tr>
	 		<td>{{$product->count}}</td>

	 		<td>{{$product->sku}}</td>
	 		<td>{{$product->name}}</td>
	 		<td>{{$product->slug}}</td>
	 		<td>{{$product->description}}</td>
	 		<td>{{$product->quantity}}</td>
	 		<td>{{$product->weight}}</td>
	 		<td>{{$product->price}}</td>
	 		<td>{{$product->sale_price}}</td>
	 		<td>{{$product->status}}</td>

	 	
	 		
	 		@auth('admin')
	 				<td class="ml-4">
			 			<div class="d-flex">
			 			<a class="btn btn-xs btn-default text-primary mx-1 shadow btn-inline" title="Edit " href = "{{route('admin.products.edit', $product->id )}}">
				                <i class="fa fa-lg fa-fw fa-pen"></i>
				        </a>        

				        <a class="btn btn-xs btn-default text-danger mx-1 shadow btn-inline" title="Delete" href = "{{route('admin.products.delete', $product->id )}}">
				                  <i class="fa fa-lg fa-fw fa-trash"></i>
				        </a>
				       
			            </div>
	        		</td> 
	 		@endauth
	 		  


	 	</tr>	
 	@endforeach
 </table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop