@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       <h2> Product </h2>
    </div>
    <div class="row justify-content-center p-2">
        @foreach($product as $product)
            <div class="card col-8 p-1">
                <div class="card-header">{{$product->name}}<p style="float:right"><b>Price:&nbsp;${{$product->price}}</b></p></div>
                <img class="card-img-top" src="{{ asset('storage/product_images/'.$product->image) }}" height="300px" alt="Card image cap">
                <div class="card-body">
                   {{$product->description}} 
                </div>
                <div class="row justify-content-center pl-2">
                    <a href="/"><Button class="btn btn-outline-primary">Back</Button></a>
                    <a href="/product/addCart/{{$product->product_id}}"><Button class="btn btn-outline-success">Add to cart<i class="fa fa-cart-plus"></i></Button></a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row justify-content-center">
      
    </div>
</div>
@endsection