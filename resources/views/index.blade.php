@extends('layouts.app')

@section('content')
<style>
  #contentoverlay{
     opacity:0.5;

  }
  #contentoverlay > div{
    display:flex;
    justify-content:center;
    align-items:center;

  }
  #contentoverlay > div > button{
    width:60px;
    height:30px;
    border-radius:10px;
  }
</style>
<div style="margin-top:2%">
<div class="card text-white">
  <img class="card-img" src="{{ asset('Images/background/backgroundimage2.jpg')}}" alt="Card image" id="contentoverlay">
  <div class="card-img-overlay" id="contentoverlay">
    <div>
    <h5 class="card-title">Ecommerce Shop</h5>
    <p class="card-text">Welcome to our ecommerce shop store feel free to tour the products.</p>
    <a href="/products" class="card-text text-white" style="text-decoration:none"><button class="btn btn-outline-primary btn-group-lg">Get Started<i class="fa fa-arrow-right"></i></a>
    </div>
  </div>
</div>

<div class="container">
    <div class="row">
      <div class="card col-5">
      <img class="card-img" src="{{ asset('Images/background/backgroundimage1.jpg')}}" alt="Card image">
        <div class="card-img-overlay" id="contentoverlay">
          <div>
          <h5 class="card-title">Ecommerce Shop</h5>
          <p class="card-text">Welcome to our ecommerce shop store feel free to tour the products.</p>
          <a href="/products" class="card-text text-white" style="text-decoration:none"><button class="btn btn-outline-primary btn-group-lg">Get Started<i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
      </div>
      <div class="card col-5 offset-1">
      <img class="card-img" src="{{ asset('Images/background/backgroundimage1.jpg')}}" alt="Card image" id="contentoverlay">
        <div class="card-img-overlay">
          <div>
          <h5 class="card-title">Ecommerce Shop</h5>
          <p class="card-text">Welcome to our ecommerce shop store feel free to tour the products.</p>
          <a href="/products" class="card-text text-white" style="text-decoration:none"><button class="btn btn-outline-primary btn-group-lg">Get Started<i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="row" style="margin-top:5%">
      <div class="card col-3 justify-content-center py-2">
      <i class="fas fa-phone-square mt-5 ml-5 mb-2 mr-5" style="font-size:80px"></i>
      Call Us On 0722222222
      </div>
      <div class="card col-3 offset-1 justify-content-center">
      <i class="fas fa-sms mt-5 ml-5 mb-2 mr-5" style="font-size:80px"></i>
      Sms on 0722222222
      </div>
      <div class="card col-3 offset-1 justify-content-center">
       <i class="fab fa-whatsapp-square mt-5 ml-5 mb-2 mr-5" style="font-size:80px"></i>
       whatsapp on 0722222222
      </div>
    </div>

</div>
</div>
@endsection