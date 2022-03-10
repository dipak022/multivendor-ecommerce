
<!-- Javascript -->
<script src="{{asset('backend/')}}/asset/bundles/libscripts.bundle.js"></script>    
<script src="{{asset('backend/')}}/asset/bundles/vendorscripts.bundle.js"></script>

<script src="{{asset('backend/')}}/asset/bundles/chartist.bundle.js"></script>
<script src="{{asset('backend/')}}/asset/bundles/knob.bundle.js"></script> <!-- Jquery Knob-->
<script src="{{asset('backend/')}}/assets/vendor/toastr/toastr.js"></script>


<script src="{{asset('backend/')}}/asset/bundles/datatablescripts.bundle.js"></script>
<script src="{{asset('backend/')}}/assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="{{asset('backend/')}}/assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="{{asset('backend/')}}/assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="{{asset('backend/')}}/assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="{{asset('backend/')}}/assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="{{asset('backend/')}}/assets/vendor/sweetalert/sweetalert.min.js"></script> 



<script src="{{asset('backend/')}}/asset/bundles/mainscripts.bundle.js"></script>
<script src="{{asset('backend/')}}/asset/js/pages/tables/jquery-datatable.js"></script>

<script src="{{asset('backend/')}}/asset/js/index.js"></script>
<script src="{{asset('backend/')}}/assets/vendor/summernote/dist/summernote.js"></script>

@yield('scripts')

<script>
    jQuery(document).ready(function() {

        $('.summernote').summernote({
            height: 350, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false, // set focus to editable area after initializing summernote
            popover: { image: [], link: [], air: [] }
        });

        $('.inline-editor').summernote({
            airMode: true
        });

    });

    window.edit = function() {
            $(".click2edit").summernote()
        },
        
    window.save = function() {
        $(".click2edit").summernote('destroy');
    }
</script>











