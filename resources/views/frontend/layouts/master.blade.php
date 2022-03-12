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

    <!-- Header Area -->
    @include('frontend.layouts.header')
    <!-- Header Area End -->

    @yield('content')

    <!-- Footer Area -->
    @include('frontend.layouts.footer')
    <!-- Footer Area -->

    @include('frontend.layouts.script')

</body>


<!-- Mirrored from demo.designing-world.com/bigshop-2.3.0/index-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Mar 2022 11:04:20 GMT -->
</html>