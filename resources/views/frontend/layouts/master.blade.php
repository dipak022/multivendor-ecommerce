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

</body>


<!-- Mirrored from demo.designing-world.com/bigshop-2.3.0/index-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Mar 2022 11:04:20 GMT -->
</html>