@extends('layouts.app')

@section('content')
<script>
    $(window).on("load",function() {
    function fade() {
        var animation_height = $(window).innerHeight() * 0.25;
        var ratio = Math.round( (1 / animation_height) * 10000 ) / 10000;

        $('.fade').each(function() {

            var objectTop = $(this).offset().top;
            var windowBottom = $(window).scrollTop() + $(window).innerHeight();

            if ( objectTop < windowBottom ) {
                if ( objectTop < windowBottom - animation_height ) {
                    $(this).css( {
                        transition: 'opacity 0.1s linear',
                        opacity: 1
                    } );

                } else {
                    $(this).css( {
                        transition: 'opacity 0.25s linear',
                        opacity: (windowBottom - objectTop) * ratio
                    } );
                }
            } else {
                $(this).css( 'opacity', 0 );
            }
        });
    }
    $('.fade').css( 'opacity', 0 );
    fade();
    $(window).scroll(function() {fade();});
});
</script>
<div class="container-fluid" style="margin-top:5%">
    <div class="row">
        <div class="col-md-2 col-xs-2 col-sm-2 card">
            <div class="row justify-content-center" >
              <p>Products </p>
            </div>
          <div class="row">
            <div class="justify-content-center pl-3 mb-2" >
            <label>Department</label>
            </div>
            <div class="row">
               <div class="col-8 offset-2">
               @foreach($department as $department)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inlineCheckbox" value="{{$department->department_id}}" name="department">
                        <label class="form-check-label" for="inlineCheckbox">{{$department->name}}</label>
                    </div>
                @endforeach
               </div>
            </div>
          </div>
          <hr>
        
            <div class="row">
                <div class="justify-content-center pl-3 mb-2" >
                    <label>Category</label>
                </div>
                <div class="row">
                    <div class="col-8 offset-2">
                       <select id="selectcategory">
                           <option value="">**choose category**</option>
                          
                       </select>
                    </div>
                </div>
             </div>
             <hr>

        </div>
        <div class="col-md-10 col-sm-10 col-xs-10">

        <div class="row justify-content-center">
            @if(Session::has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif 
        </div>
        <div class="row justify-content-center">
           <h3>All Products</h3>
        </div>
        <div class="row justify-content-center" id="products">
        @foreach($products as $product)
                <div class="card col-3 m-2 p-0 fade">
                    <div class="card-header">{{$product->name}}<p style="float:right"><b>Price:&nbsp;${{$product->price}}</b></div>

                    <div class="card-body">
                    <img class="card-img-top" src="{{ asset('storage/product_images/'.$product->thumbnail) }}" alt="Card image cap">
                    {{$product->description}} 
                    </div>

                    <div class="card-footer">
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mr-2" role="group" aria-label="First group">
                            <a href="/product/{{$product->product_id}}" class="col-3"><Button class="btn btn-outline-secondary">View Product</Button></a>
                            </div>
                            <div class="btn-group mr-2 mt-1" role="group" aria-label="Second group">
                            <a href="/product/addCart/{{$product->product_id}}" class="col-4"><Button class="btn btn-outline-success">Add to cart<i class="fa fa-cart-arrow-down"></i></Button></a>
                            </div>
                        </div>
                       
                    </div>
                </div>

        @endforeach
        </div>
        <div class="row justify-content-center">
            {{ $products->links() }}
        </div>
        </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

            var $radios = $('input[name="department"]');

            $radios.change(function() {
            var $checked = $radios.filter(function() {
                return $(this).prop('checked');
            });
            var id = $checked.val();
                $.ajax({
                    method:'get',
                    url:'/products/category',
                    data:{id:id},
                    dataType:'json',
                    success:function(data){
                        $("#selectcategory").empty();
                       //empty the category if there is data
                        $.each(data,function(index,categorydata){
                           //$("#products").append("<div class='card col-3 m-2'>div class='card-header'>"+productdata.name+"<p style='float:right'><b>Price:&nbsp;"+productdata.price+"</b></div><div class='card-body'><img class='card-img-top' src='storage/product_images/'"+productdata.thumbnail+" alt='Card image cap'>"+productdata.description +"</div><div class='card-footer row'><a href='/product/'"+productdata.product_id+" class='col-3'><Button class='btn btn-outline-secondary'>View Product</Button></a><a href='/product/addCart/'"+productdata.product_id+" class='col-4 offset-3'><Button class='btn btn-outline-success'>Add to cart<i class='fa fa-cart-arrow-down'></i></Button></a></div></div>");
                        $("#selectcategory").append("<option value='"+categorydata.category_id+"'>"+categorydata.name+"</option>")
                        });

                    }
                    
                })
            });

            $("#selectcategory").on('change',function(){
                var categoryid=$("#selectcategory").val();
                //alert(categoryid);
                $.ajax({
                    method:'get',
                    url:'category/products',
                    data:{id:categoryid},
                    dataType:'json',
                    success:function(data){
                        $("#products").empty();
                        console.log(data);
                       //empty the category if there is data
                        $.each(data,function(index,productdata){
                            var img = '<img class="card-img-top" src="{{asset(Storage::url('product_images'))}}/'+productdata.thumbnail+'">';
                           $("#products").append("<div class='card col-3 m-2'><div class='card-header'>"+productdata.name+"<p style='float:right'><b>Price:&nbsp;"+productdata.price+"</b></div><div class='card-body'>"+img+productdata.description +"</div><div class='card-footer row'><a href='/product/"+productdata.product_id+"' class='col-3'><Button class='btn btn-outline-secondary'>View Product</Button></a><Button class='btn btn-outline-success' id='addcart' value="+productdata.product_id+">Add to cart<i class='fa fa-cart-arrow-down'></i></Button></div></div>");
                    
                        });

                    }
                    
                })
            });


            //add to cart
            $("#addcart").click(function(){
                //var productid = $("#addcart").val();
                alert("hello");
            });
      })
    </script>
@endsection