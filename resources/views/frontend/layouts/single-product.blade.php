

<div class="single-product-area mb-30">
    @php
        $photo = explode(',',$product->photo)
    @endphp
    <div class="product_image">
        
        <img class="normal_img" src="{{ asset($photo[0]) }}" alt="{{$product->title}}">
        <img class="hover_img" src="{{ asset($photo[0]) }}" alt="{{$product->title}}">

        
        <div class="product_badge">
            <span>{{  $product->conditions }}</span>
        </div>

        <div class="product_wishlist">
            <a href="javascript:void(0)" class="add_to_wishlist" data-quantity="1" data-id="{{ $product->id }}" id="add_to_wishlist_{{ $product->id }}"  ><i class="icofont-heart"></i></a>
        </div>

        
        <div class="product_compare">
            <a href="cjavascript:void(0)" class="addd_to_compare" data-id="{{ $product->id }}" id="add_to_compare_{{ $product->id }}" ><i class="icofont-exchange"></i></a>
        </div>
    </div>

    <div class="product_description">
        <div class="product_add_to_cart">
            <a href="#" data-quantity="1" data-product-id="{{ $product->id }}" class="add_to_cart" id="add_to_cart{{ $product->id }}"><i class="icofont-shopping-cart"></i> Add to Cart</a>
        </div>
        <div class="product_quick_view">
            <a href="#" data-toggle="modal" data-target="#quickview{{$product->id}}"><i class="icofont-eye-alt"></i> Quick View</a>
        </div>

        <p class="brand_name">{{ \App\Models\Brand::where('id',$product->brand_id)->value('title') }}</p>
        <a href="{{ route('product.detail',$product->slug) }}">{{ucfirst($product->title)}}</a>
        <h6 class="product-price">{{number_format($product->offer_price,2)}} TK <span><del class="text-danger">{{number_format($product->price,2)}} TK</del></span></h6>
    </div>
</div>

<!-- Quick View Modal Area -->
<div class="modal fade" id="quickview{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="quickview" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <div class="quickview_body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-5">
                                <div class="quickview_pro_img">
                                    @php
                                        $photo = explode(',',$nproduct->photo)
                                    @endphp
                                    <img class="normal_img" src="{{ $photo[0] }}" alt="{{$nproduct->title}}">
                                    <img class="hover_img" src="{{ $photo[0] }}" alt="{{$nproduct->title}}">
                                    <!-- Product Badge -->
                                    <div class="product_badge">
                                        <span>{{$nproduct->conditions}} </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-7">
                                <div class="quickview_pro_des">
                                    <h4 class="title">{{ucfirst($product->title)}}</h4>
                                    <div class="top_seller_product_rating mb-15">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    <h5 class="price">{{number_format($product->offer_price,2)}} TK <span>{{number_format($product->price,2)}} TK</span></h5>
                                    <p>{!! $product->description !!}</p>
                                    <a href="{{ route('product.detail',$product->slug) }}">View Full Product Details</a>
                                </div>
                                <!-- Add to Cart Form -->
                                <form class="cart" method="post">
                                    <div class="quantity">
                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="12" name="quantity" value="1">
                                    </div>
                                    <a href="#" data-quantity="1" data-product-id="{{ $product->id }}" class="add_to_cart" id="add_to_cart{{ $product->id }}"><i class="icofont-shopping-cart"></i> Add to Cart</a>
                                    
                                    <!-- Wishlist -->
                                    <div class="modal_pro_wishlist">
                                    <a href="javascript:void(0)" class="add_to_wishlist" data-quantity="1" data-id="{{ $product->id }}" id="add_to_wishlist_{{ $product->id }}"  ><i class="icofont-heart"></i></a>
                                    </div>
                                    <!-- Compare -->
                                    <div class="modal_pro_compare">
                                        <a href="cjavascript:void(0)" class="addd_to_compare" data-id="{{ $product->id }}" id="add_to_compare_{{ $product->id }}" ><i class="icofont-exchange"></i></a>
                                    </div>
                                </form>
                                <!-- Share -->
                                <div class="share_wf mt-30">
                                    <p>Share with friends</p>
                                    <div class="_icon">
                                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                        <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quick View Modal Area -->  



@section('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--add to compare -->
<script>
    $(document).on('click','.addd_to_compare',function(e){
        e.preventDefault();
        var product_id = $(this).data('id');
        var token = "{{csrf_token()}}";
        var path = "{{ route('compare.store') }}";
 
        $.ajax({
            url:path,
            type:"POST",
            dataType:"JSON",
            data:{
                product_id : product_id,
                _token : token,
            },
            beforeSend:function(){
                $('#add_to_compare_'+product_id).html('<i class="fa fa-spinner fa-spin"></i>');
            },
            complete:function(){
                $('#add_to_compare_'+product_id).html('<i class="fas fa-exchange"></i>');
            },
            success:function(data){
                //console.log(dara);
                
                if(data['status']){
                     $('body #header-ajax').html(data['header']);
                     $('body #compaer_counter').html(data['compaer_count']);
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
                         text: data['message'],
                         icon: "error",
                         button: "ok!",
                     });
 
                }
            }
 
        });
 
    });
 </script>

 <!--add to cart  -->
<script>
    $(document).on('click','.add_to_cart',function(e){
        e.preventDefault();
        var product_id = $(this).data('product-id');
        //alert(product_id);
        var product_qty = $(this).data('quantity');
        //alert(product_qty);
        var token = "{{csrf_token()}}";
        var path = "{{ route('cart.store') }}";
 
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
                $('#add_to_cart'+product_id).html('<i class="fa fa-spinner fa-spin"></i> Loaging...');
            },
            complete:function(){
                $('#add_to_cart'+product_id).html('<i class="fa fa-cart-plus"></i> Add To Cart');
            },
            success:function(data){
                //console.log(dara);
                $('body #header-ajax').html(data['header'])
                if(data['status']){
                 swal({
                 title: "Good job!",
                 text: data['message'],
                 icon: "success",
                 button: "ok!",
                 });
                }
            }
 
        });
 
    });
 </script>
 @endsection

  

