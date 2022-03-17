  <!-- jQuery (Necessary for All JavaScript Plugins) -->
  <script src="{{asset('frontend/')}}/js/jquery.min.js"></script>
    <script src="{{asset('frontend/')}}/js/popper.min.js"></script>
    <script src="{{asset('frontend/')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('frontend/')}}/js/jquery.easing.min.js"></script>
    <script src="{{asset('frontend/')}}/js/default/classy-nav.min.js"></script>
    <script src="{{asset('frontend/')}}/js/owl.carousel.min.js"></script>
    <script src="{{asset('frontend/')}}/js/default/scrollup.js"></script>
    <script src="{{asset('frontend/')}}/js/waypoints.min.js"></script>
    <script src="{{asset('frontend/')}}/js/jquery.countdown.min.js"></script>
    <script src="{{asset('frontend/')}}/js/jquery.counterup.min.js"></script>
    <script src="{{asset('frontend/')}}/js/jquery-ui.min.js"></script>
    <script src="{{asset('frontend/')}}/js/jarallax.min.js"></script>
    <script src="{{asset('frontend/')}}/js/jarallax-video.min.js"></script>
    <script src="{{asset('frontend/')}}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{asset('frontend/')}}/js/jquery.nice-select.min.js"></script>
    <script src="{{asset('frontend/')}}/js/wow.min.js"></script>
    <script src="{{asset('frontend/')}}/js/default/active.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    
    <script>
    @if(Session::has('message'))
            var type="{{Session::get('alert-type','info')}}"

    
            switch(type){
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
            case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
    @endif
</script>

@yield('scripts')