<!doctype html>
<html lang="en">


<!-- Mirrored from demo.designing-world.com/bigshop-2.3.0/index-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Mar 2022 11:01:27 GMT -->
<head>
  @include('frontend.layouts.head')
</head>

<body>
    <!-- Preloader 
    <div id="preloader">
        <div class="spinner-grow" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    -->
    <header class="header_area" id="header-ajax">
    <!-- Header Area -->
    @include('frontend.layouts.header')
    <!-- Header Area End -->
    </header>

    @yield('content')

    <!-- Footer Area -->
    @include('frontend.layouts.footer')
    <!-- Footer Area -->

    @include('frontend.layouts.script')
    <script>
     $(document).ready(function(){
         var path = {{route('autosearch')}};
         $('#search_text').autocomplete({
             source:function(request,response){
                 $.ajax({
                     url:path,
                     dataType:"JSON",
                     data:{
                         term:request.term
                     },
                     success:function(data){
                         response(data);
                     }
                 });
             },
             minLength:1,
         });
     });
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
     $(document).on('click','.cart_delete',function(e){
       e.preventDefault();
       var cart_id = $(this).data('id');
       //alert(cart_id);
       
       var token = "{{csrf_token()}}";
       var path = "{{ route('cart.delete') }}";

       $.ajax({
           url:path,
           type:"POST",
           dataType:"JSON",
           data:{
               cart_id : cart_id,
               _token : token,
           },
           success:function(data){
               //alert(data['cart_count']);
               //console.log(dara);
               if(data['status']){
                $('body #header-ajax').html(data['header']);
                $('body #cart_counter').html(data['cart_count']);
                swal({
                title: "Good job!",
                text: data['message'],
                icon: "success",
                button: "ok!",
                });
               }
           },
           error:function(err){
            console.log(err);
           }

       });

   });
    </script>

    <!--add to wishlist -->

<script>
    $(document).on('click','.add_to_wishlist',function(e){
        e.preventDefault();
        var product_id = $(this).data('id');
        //alert(product_id);
        var product_qty = $(this).data('quantity');
        //alert(product_qty);
        var token = "{{csrf_token()}}";
        var path = "{{ route('wishlist.store') }}";
 
        $.ajax({
            url:path,
            type:"POST",
            dataType:"JSON",
            data:{
                product_id : product_id,
                product_qty : product_qty,
                _token : token,
            },
            beforeSend:function(){
                $('#add_to_wishlist_'+product_id).html('<i class="fa fa-spinner fa-spin"></i>');
            },
            complete:function(){
                $('#add_to_wishlist_'+product_id).html('<i class="fas fa-heart"></i>');
            },
            success:function(data){
                //console.log(dara);
                
                if(data['status']){
                     $('body #header-ajax').html(data['header']);
                     $('body #wishlist_count').html(data['wishlist_count']);
                     swal({
                         title: "Good job!",
                         text: data['message'],
                         icon: "success",
                         button: "ok!",
                     });
                }else if(data['present']){
                     $('body #header-ajax').html(data['header']);
                     $('body #wishlist_count').html(data['wishlist_count']);
                     swal({
                         title: "Opps!",
                         text: data['message'],
                         icon: "warning",
                         button: "ok!",
                     });
 
                }else{
                     swal({
                         title: "Sorry!",
                         text: "can't add that product !! try again!",
                         icon: "error",
                         button: "ok!",
                     });
 
                }
            }
 
        });
 
    });
 </script>

    

</body>


<!-- Mirrored from demo.designing-world.com/bigshop-2.3.0/index-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Mar 2022 11:04:20 GMT -->
</html>