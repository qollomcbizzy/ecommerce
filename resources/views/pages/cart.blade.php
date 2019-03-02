@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:5%;">
    <div class="row justify-content-center">
       <h2> Your Cart </h2>
    </div>
    @if(Session::has('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif
    <div class="row justify-content-center">
      <table class="table table-stripped table-dark">
          <thead>
              <tr>
                  <th scope="col">Product Name</th>
                  <th scope="col">Product Description</th>
                  <th scope="col">Product Price</th>
                  <th scope="col">Product Discount</th>
                  <th scope="col">Product Quantity</th>
              </tr>
          </thead>
          <tbody>
              <?php $total = 0 ?>
            @if(Session::has('cart'))
            @foreach(session('cart') as $id => $details)
            <?php $total += ($details['price']-$details['discount'])*$details['quantity'];?>
            <tr>
                <td>{{$details['name']}}</td>
                <td>{{$details['description']}}</td>
                <td><i class="fa fa-dollar-sign"></i>{{$details['price'] }}</td>
                <td><i class="fa fa-dollar-sign">{{$details['discount']}}</td>
                <td>{{$details['quantity']}}</td>
               <td><button class="btn btn-success btn-md update-cart" data-id="{{ $id}}">Add</button></td>
                <td><button class="btn btn-danger btn-md remove-from-cart" data-id="{{ $id }}">Remove</button></td>
            </tr>
            @endforeach
            @endif
          </tbody>
      </table>
    </div>
    <hr>
    <div style="margin-top:3%;padding:20px;" class="bg-dark">
        <div class="row justify-content-center mb-2">
            <label class="text-white">Total price :</label> <div style="border:1px solid gray;padding:5px;border-radius:2px;" class="bg-white">$ {{$total}}</div>
        </div>
        <div class="row justify-content-center mb-2">
        <a href="{{ url('/products')}}" class="text-dark"><button class="btn btn-outline-info btn-lg">Continue Shopping</button></a>
        </div>
        <div class="row justify-content-center">
        <a href="#"><button class="btn btn-outline-success btn-lg">Pay</button></a>
        </div>
    </div>
    <hr>
</div>

<script type="text/javascript">
 
       $(document).ready(function(){
        $(".update-cart").click(function (e) {
           e.preventDefault();
 
           var ele = $(this);
 
            $.ajax({
               url: '{{ url('update-cart') }}',
               method: "patch",
               data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
               success: function (response) {
                   window.location.reload();
               }
            });
        });
 
        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
 
            var ele = $(this);
 
            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
       })
 
    </script>
@endsection