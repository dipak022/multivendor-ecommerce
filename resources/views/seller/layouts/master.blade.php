
<!doctype html>
<html lang="en">

<head>
@include('seller.layouts.header')
</head>
<body class="theme-cyan">


<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="{{asset('backend/assets/')}}/loader.gif" width="48" height="48" alt="Lucid"></div>
        <p>Please wait...</p>        
    </div>
</div>


<div id="wrapper">
@include('seller.layouts.nav')
@include('seller.layouts.sideber')

    

 @yield('content')
    


</div>
</body>
@include('seller.layouts.footer')
</html>
