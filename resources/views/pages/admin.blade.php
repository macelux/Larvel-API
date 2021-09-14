



@extends('adminlte::page')

@section('title', 'Admins')

@section('content_header')
    <h1>Admins</h1>
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



    <a href = "{{route('admin.admin.create')}}" class="btn btn-primary pull-right float-right mb-3">Add Admin</a>




    <table class="table table-bordered ">
        <tr>
            <td> S/N  </td>
            <td> Name</td>
            <td> Email </td>

            <td> 	is_super</td>
            @can('is_super_admin')
                <td> Actions</td>
            @endcan 

        </tr> 
        @foreach($Admins as $admin)

            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>

                <td>{{$admin->is_super==1?"True":"False"}}</td>


                @if(Auth::guard('admin')->user()->is_super == 1)
                    <td class="ml-4">
                        <div class="d-flex">
                            <a class="btn btn-xs btn-default text-primary mx-1 shadow btn-inline" title="Edit " href = "{{route('admin.admin.edit', $admin->id )}}">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>

                            <a class="btn btn-xs btn-default text-danger mx-1 shadow btn-inline" title="Delete" href = "{{route('admin.admin.delete', $admin->id )}}">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </a>

                        </div>
                    </td>
                @endif 

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