@extends('frontend.layouts.master')

@section('content')

  <!-- Breadcumb Area -->
  <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Cart</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Cart Area -->
    <div class="cart_area section_padding_100_70 clearfix">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12">
                    <div class="cart-table">
                        <div class="table-responsive" id="cart_list">
                            @include('frontend.layouts.cart-list')
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="cart-apply-coupon mb-30">
                        <h6>Have a Coupon?</h6>
                        <p>Enter your coupon code here &amp; get awesome discounts!</p>
                        <!-- Form -->
                        <div class="coupon-form" >
                            <form action="{{ route('coupon.add') }}" method="post" id="coupon-form">
                                @csrf
                                <input type="text" class="form-control" name="code" placeholder="Enter Your Coupon Code">
                                <button type="submit" class="btn btn-primary coupon-btn" >Apply Coupon</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="cart-total-area mb-30">
                        <h5 class="mb-3">Cart Information</h5>
                        <div class="table-responsive">
                            <table class="table mb-3">
                                <tbody>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>{{ \Gloudemans\Shoppingcart\Facades\Cart::subtotal() }}TK</td>
                                    </tr>
                                    <tr>
                                        <td>Save Amount</td>
                                        <td>@if(Illuminate\Support\Facades\Session::has('coupon')){{ number_format(\Illuminate\Support\Facades\Session::get('coupon')['value']) }} TK @else 0 @endif</td>
                                    </tr>
                                    <tr>
                                        <td>VAT (10%)</td>
                                         @if(Illuminate\Support\Facades\Session::has('coupon'))
                                        <td>{{number_format((float) str_replace(',','',\Gloudemans\Shoppingcart\Facades\Cart::subtotal()) - session('coupon')['value'],2) }} TK</td>
                                        @else

                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>$71.60</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('checkout1') }}" class="btn btn-primary d-block">Proceed To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Area End -->

@endsection

@section('scripts')
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
                $('body #cart-counter').html(data['cart_count']);
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

    <script>
       $(document).on('click','.qty-text',function(){

        var id = $(this).data('id');
        //alert(id);
        var spinner = $(this),input = spinner.closest("div.quantity").find('input[type="number"]');
        //alert(input.val()); 
        if(input.val()==1){
            return false;
        }
        if(input.val() !=1){
            var newVal= parseFloat(input.val());
            $('#qty-input-'+id).val(newVal);
            //alert(newVal);
        }
        var ProductQuantity = $("#updates-cart-"+id).data('product-quantity');
        //alert(ProductQuantity);
        update_cart(id,ProductQuantity);


       });
       function update_cart(id,ProductQuantity){
           var rowId = id;
           var product_qty = $('#qty-input-'+rowId).val();
           var token = "{{csrf_token()}}";
           var path = "{{ route('cart.update') }}";

           $.ajax({
           url:path,
           type:"POST",
           data:{
               _token : token,
               product_qty : product_qty,
               rowId : rowId,
               ProductQuantity: ProductQuantity,
           },
           success:function(data){
               if(data['status']){
                $('body #header-ajax').html(data['header']);
                $('body #cart-counter').html(data['cart_count']);
                $('body #cart_list').html(data['cart_list']);
                swal({
                title: "Good job!",
                text: data['message'],
                icon: "success",
                button: "ok!",
                });
                //alert(data['message']);
               }else{
                   alert(data['message']);
               }
           },
           error:function(err){
            console.log(err);
           }

       });

       }
    </script>

    <script>
       $(document).on('click','.coupon-btn',function(e){
           e.preventDefault();
           var code = $('input[name=code]').val();
           //alert(code);
           $('.coupon-btn').html('<i class="fa fa-spinner fa-spin"></i> Applying...');
           $('#coupon-form').submit(); 
       });
    </script>

@endsection