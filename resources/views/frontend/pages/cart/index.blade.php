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
                        <div class="table-responsive">
                            <table class="table table-bordered mb-30">
                                <thead>
                                    <tr>
                                        <th scope="col"><i class="icofont-ui-delete"></i></th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                                        <tr>
                                            <th scope="row">
                                                <i class="icofont-close cart_delete" data-id="{{ $item->rowId }}"></i>
                                            </th>
                                            <td>
                                                <img src="{{$item->model->photo}}" alt="{{ $item->model->slug }}">
                                            </td>
                                            <td>
                                                <a href="{{ route('product.detail',$item->model->slug) }}">{{$item->name}}</a>
                                            </td>
                                            <td>{{ number_format($item->price,2) }} TK</td>
                                            <td>
                                                <div class="quantity">
                                                    <input type="number" class="qty-text" data-id="{{ $item->rowId }}" id="qty-input-{{ $item->rowId }}" step="1" min="1" max="99" name="quantity" value="{{ $item->qty }}">
                                                    <input type="hidden"  data-id="{{ $item->rowId }}" data-product-quantity="{{ $item->model->stock }}" id="update-cart-{{ $item->rowId }}" >
                                                </div>
                                            </td>
                                            <td>{{ \Gloudemans\Shoppingcart\Facades\Cart::subtotal() }} TK</td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="cart-apply-coupon mb-30">
                        <h6>Have a Coupon?</h6>
                        <p>Enter your coupon code here &amp; get awesome discounts!</p>
                        <!-- Form -->
                        <div class="coupon-form">
                            <form action="#">
                                <input type="text" class="form-control" placeholder="Enter Your Coupon Code">
                                <button type="submit" class="btn btn-primary">Apply Coupon</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="cart-total-area mb-30">
                        <h5 class="mb-3">Cart Totals</h5>
                        <div class="table-responsive">
                            <table class="table mb-3">
                                <tbody>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>$56.00</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td>$10.00</td>
                                    </tr>
                                    <tr>
                                        <td>VAT (10%)</td>
                                        <td>$5.60</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>$71.60</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="checkout-1.html" class="btn btn-primary d-block">Proceed To Checkout</a>
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
        }


       });
    </script>
@endsection