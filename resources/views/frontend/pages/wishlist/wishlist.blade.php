@extends('frontend.layouts.master')

@section('content')

 <!-- Breadcumb Area -->
 <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Wishlist</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Wishlist</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Wishlist Table Area -->
    <div class="wishlist-table section_padding_100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cart-table wishlist-table">
                        <div class="table-responsive" id="wishlist_list">
                        @include('frontend.layouts.wishlist')
                        </div>
                    </div>
                    <!--
                    <div class="cart-footer text-right">
                        <div class="back-to-shop">
                            <a href="#" class="btn btn-primary">Add All Item</a>
                        </div>
                    </div>
                    -->
                </div>
            </div>
        </div>
    </div>
    <!-- Wishlist Table Area -->


@endsection

@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
       $('.move-to-cart').on('click',function(e){
           e.preventDefault();
           var rowId = $(this).data('id');
           //alert(rowId);
           var token = "{{csrf_token()}}";
           var path = "{{ route('wishlist.move.cart') }}";

           $.ajax({
           url:path,
           type:"POST",
           data:{
               _token : token,
               rowId : rowId,
           },
           beforeSend:function(){
               $('.move-to-cart').html('<i class="fa fa-spinner fa-spin"></i> Moveing To Cart...');
           },
           
           success:function(data){
               if(data['status']){
                    $('body #header-ajax').html(data['header']);
                    $('body #cart-counter').html(data['cart_count']);
                    $('body #wishlist_list').html(data['wishlist_list']);
                    swal({
                        title: "Success!",
                        text: data['message'],
                        icon: "success",
                        button: "ok!",
                    });
                   //alert(data['message']);
               }else{
                    swal({
                        title: "Opps!",
                        text: "Something went to wrong",
                        icon: "warning",
                        button: "ok!",
                    });
               }
           },
           error:function(err){
                swal({
                    title: "Error!",
                    text: "Something went to Error",
                    icon: "error",
                    button: "ok!",
                });
           }

       });

       })
    </script>
  

@endsection