

@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Reviews</h1>
@stop

@section('content')
    <div class="classes_content">





        <table class="table table-bordered ">
            <tr>
                <td> S/N  </td>
                <td> Customer </td>
                <td> 	Product </td>
                <td> 	Content  </td>




            </tr>
            @foreach($Reviews as $review)

                <tr>
                    <td>{{$review->count}}</td>

                    <td>{{$review->user->fullname}}</td>

                    @foreach($review->product as $product)


                        <td>{{$product->name }}</td>
                    @endforeach

                    <td>{{$review->	body}}</td>








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