
<!doctype html>
<html lang="en">

<head>
@include('backend.layouts.header')
</head>
<body class="theme-cyan">


<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="{{asset('backend/assets/')}}/loader.gif" width="48" height="48" alt="Lucid"></div>
        <p>Please wait...</p>        
    </div>
</div>


<div id="wrapper">
@include('backend.layouts.nav')
@include('backend.layouts.sideber')

    

 @yield('content')
    


</div>
</body>
@include('backend.layouts.footer')
</html>
