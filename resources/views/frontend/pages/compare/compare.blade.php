@extends('frontend.layouts.master')

@section('content')

 <!-- Breadcumb Area -->
 <div class="breadcumb_area">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <h5>Compare</h5>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Compare</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Breadcumb Area -->

<!-- Compare Area  -->
<div class="compare_area section_padding_100 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="compare-list">
                    <div class="table-responsive" id="compare">
                        @include('frontend.layouts.compare')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Area End -->


@endsection

@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- compare product move to cart-->
    <script>
       $('.move-to-cart').on('click',function(e){
           e.preventDefault();
           var rowId = $(this).data('id');
           //alert(rowId);
           var token = "{{csrf_token()}}";
           var path = "{{ route('compare.move.cart') }}";

           $.ajax({
           url:path,
           type:"POST",
           data:{
               _token : token,
               rowId : rowId,
           },
           
           success:function(data){
               if(data['status']){
                    $('body #header-ajax').html(data['header']);
                    $('body #cart-counter').html(data['cart_count']);
                    $('body #wishlist_list').html(data['wishlist_list']);
                    $('body #compare').html(data['compare_list']);
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

    <!-- compare product move to wishlist-->
    <script>
       $('.move-to-wishlist').on('click',function(e){
           e.preventDefault();
           var rowId = $(this).data('id');
           //alert(rowId);
           var token = "{{csrf_token()}}";
           var path = "{{ route('compare.move.wishlist') }}";

           $.ajax({
           url:path,
           type:"POST",
           data:{
               _token : token,
               rowId : rowId,
           },
           
           success:function(data){
               if(data['status']){
                    $('body #header-ajax').html(data['header']);
                    $('body #cart-counter').html(data['cart_count']);
                    $('body #wishlist_list').html(data['wishlist_list']);
                    $('body #compare').html(data['compare_list']);
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



    <!--delete compare-->
    <script>
       $('.delete-compare').on('click',function(e){
           e.preventDefault();
           var rowId = $(this).data('id');
           //alert(rowId);
           var token = "{{csrf_token()}}";
           var path = "{{ route('compare.delete') }}";

           $.ajax({
           url:path,
           type:"POST",
           data:{
               _token : token,
               rowId : rowId,
           },
           beforeSend:function(){
               $('.delete_wishlist').html('<i class="fa fa-spinner fa-spin"></i> Deleting wishlist...');
           },
           
           success:function(data){
               if(data['status']){
                    $('body #header-ajax').html(data['header']);
                    $('body #cart-counter').html(data['cart_count']);
                    $('body #wishlist_list').html(data['wishlist_list']);
                    $('body #compare').html(data['compare_list']);
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