

@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Users</h1>
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
 		<td> S/N </td>
 		<td> Name</td>

 		<td> Email  </td>

 		<td> Address </td>
 		<td> City </td>
 		<td> Country</td>

 		

 		<!-- @can('admins') -->
 		@auth('admin')
 			<td>Actions</td>
 		<!-- @endcan	 -->
 		@endauth
 		  			


 	</tr>

 	@foreach($Users as $user)

	 	<tr>


			<td>{{$user->count}}</td>
	 		<td>{{$user->full_name}}</td>

	 		<td>{{$user->email}}</td>

	 		<td>{{$user->address}}</td>
	 		<td>{{$user->city}}</td>
	 		<td>{{$user->country}}</td>





	 		@auth('admin')
	 				<td class="ml-4">
			 			<div class="d-flex">
			 			<a class="btn btn-xs btn-default text-primary mx-1 shadow btn-inline" title="Edit " href = "{{route('admin.users.edit', $user->id )}}">
				                <i class="fa fa-lg fa-fw fa-pen"></i>
				        </a>

				        <a class="btn btn-xs btn-default text-danger mx-1 shadow btn-inline" title="Delete" href = "{{route('admin.users.delete', $user->id )}}">
				                  <i class="fa fa-lg fa-fw fa-trash"></i>
				        </a>

			            </div>
	        		</td>
	 		@endauth



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