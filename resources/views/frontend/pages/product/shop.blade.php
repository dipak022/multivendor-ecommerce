@extends('frontend.layouts.master')

@section('content')

 <!-- Breadcumb Area -->
 <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Shop Grid</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Shop Grid</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <section class="shop_grid_area section_padding_100">
        <div class="container">
        <form action="{{ route('shop.filter') }}" method="post">
            @csrf 
            <div class="row">
                
                <div class="col-12 col-sm-5 col-md-4 col-lg-3">
                
                    <div class="shop_sidebar_area">
                        @if(count($cats)>0)
                            <!-- Single Widget -->
                            <div class="widget catagory mb-30">
                                <h6 class="widget-title">Product Categories</h6>
                                <div class="widget-desc">
                                    @if(!empty($_GET['category']))
                                        @php
                                            $filter_cats= explode(',',$_GET['category']);
                                        @endphp
                                    @endif
                                    @foreach($cats as $cat)
                                    <!-- Single Checkbox -->
                                    <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                        <input type="checkbox" @if(!empty($filter_cats) && in_array($cat->slug,$filter_cats))) checked @endif class="custom-control-input" id="{{$cat->slug}}" name="category[]" onchange="this.form.submit();" value="{{ $cat->slug }}">
                                        <label class="custom-control-label" for="{{$cat->slug}}">{{ucfirst($cat->title)}} <span class="text-muted">({{count($cat->products)}})</span></label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Single Widget -->
                        <div class="widget price mb-30">
                            <h6 class="widget-title">Filter by Price</h6>
                            <div class="widget-desc">
                                <div class="slider-range">
                                    <div id="slider-range" data-min="{{Helpers::minPrice()}}" data-max="{{Helpers::maxPrice()}}" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="{{Helpers::minPrice()}}" data-value-max="{{Helpers::maxPrice()}}" data-label-result="Price:">
                                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    </div>
                                    <input type="hidden" id="price_range" @if(!empty($_GET['price'])) {{$_GET['price']}}  @endif name="price_range">
                                    <input type="text" readonly id="amount" style="border:0;width:50%;" value="{{Helpers::minPrice()}}-{{Helpers::maxPrice()}}">
                                    <!--
                                    <div class="range-price">Price: {{Helpers::minPrice()}} Tk - {{Helpers::maxPrice()}} Tk</div>
                                    -->
                                    <button type="submit" class="btn btn-sm btn-primary">filter</button>
                                </div>
                            </div>
                        </div>

                        <!-- Single Widget -->
                        <div class="widget color mb-30">
                            <h6 class="widget-title">Filter by Color</h6>
                            <div class="widget-desc">
                                <!-- Single Checkbox -->
                                <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck6">
                                    <label class="custom-control-label black" for="customCheck6">Black <span class="text-muted">(9)</span></label>
                                </div>
                                <!-- Single Checkbox -->
                                <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck7">
                                    <label class="custom-control-label pink" for="customCheck7">Pink <span class="text-muted">(6)</span></label>
                                </div>
                                <!-- Single Checkbox -->
                                <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck8">
                                    <label class="custom-control-label red" for="customCheck8">Red <span class="text-muted">(8)</span></label>
                                </div>
                                <!-- Single Checkbox -->
                                <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck9">
                                    <label class="custom-control-label purple" for="customCheck9">Purple <span class="text-muted">(4)</span></label>
                                </div>
                                <!-- Single Checkbox -->
                                <div class="custom-control custom-checkbox d-flex align-items-center">
                                    <input type="checkbox" class="custom-control-input" id="customCheck10">
                                    <label class="custom-control-label orange" for="customCheck10">Orange <span class="text-muted">(7)</span></label>
                                </div>
                            </div>
                        </div>
                         @if(count($brands)>0)
                        <!-- Single Widget -->
                        <div class="widget brands mb-30">
                            <h6 class="widget-title">Filter by brands</h6>
                            <div class="widget-desc">
                                    @if(!empty($_GET['brand']))
                                        @php
                                            $filter_brand= explode(',',$_GET['brand']);
                                        @endphp
                                    @endif
                                @foreach($brands as $bra)
                                <!-- Single Checkbox -->
                                
                                    <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                        <input type="checkbox"  @if(!empty($filter_brand) && in_array($bra->slug,$filter_brand))) checked @endif class="custom-control-input" id="{{$bra->slug}}" name="brand[]"  value="{{ $bra->slug }}" onchange="this.form.submit();">
                                        <label class="custom-control-label" for="{{$bra->slug}}">{{$bra->title}} <span class="text-muted">({{count($bra->products)}})</span></label>
                                    </div>
                               @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Single Widget -->
                        <div class="widget rating mb-30">
                            <h6 class="widget-title">Average Rating</h6>
                            <div class="widget-desc">
                                <ul>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <span class="text-muted">(103)</span></a></li>

                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <span class="text-muted">(78)</span></a></li>

                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <span class="text-muted">(47)</span></a></li>

                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <span class="text-muted">(9)</span></a></li>

                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <span class="text-muted">(3)</span></a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Single Widget -->
                        <div class="widget size mb-30">
                            <h6 class="widget-title">Filter by Size</h6>
                            <div class="widget-desc">
                                <ul>
                                    <li><a href="#">XS</a></li>
                                    <li><a href="#">S</a></li>
                                    <li><a href="#">M</a></li>
                                    <li><a href="#">L</a></li>
                                    <li><a href="#">XL</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="col-12 col-sm-7 col-md-8 col-lg-9">
                    <!-- Shop Top Sidebar -->
                    <div class="shop_top_sidebar_area d-flex flex-wrap align-items-center justify-content-between">
                        <div class="view_area d-flex">
                            <div class="grid_view">
                                <a href="shop-grid-left-sidebar.html" data-toggle="tooltip" data-placement="top" title="Grid View"><i class="icofont-layout"></i></a>
                            </div>
                            <div class="list_view ml-3">
                                <a href="shop-list-left-sidebar.html" data-toggle="tooltip" data-placement="top" title="List View"><i class="icofont-listine-dots"></i></a>
                            </div>
                        </div>
                        <select id="sortBy" name="sortBy" onchange="this.form.submit();" class="small right">
                            <option >Short by Default</option>
                            <option value="priceAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=="priceAsc") selected @endif>Short by Price - Lower To Higher</option>
                            <option value="priceDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=="priceDesc") selected @endif>Short by Price - Higher To Lower</option>
                            <option value="titelAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=="titelAsc") selected @endif>Short by Alphabetical Ascending</option>
                            <option value="titelDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=="titelDesc") selected @endif>Short by Alphabetical Descending</option>
                            <option value="discAsc"   @if(!empty($_GET['sortBy']) && $_GET['sortBy']=="discAsc")) selected @endif>Short by Discount - Lower To Higher</option>
                            <option value="discDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=="discDesc") selected @endif>Short by Discount - Higher To Lower</option>
                            <!--
                            <option value="2">Short by Sales</option>
                            <option value="3">Short by Ratings</option>
                            -->
                        </select>
                    </div>

                    <div class="shop_grid_product_area">
                        <div class="row justify-content-center">
                            <!-- Single Product -->
                            @if(count($products)>0)
                            @foreach($products as $item)
                            <div class="col-9 col-sm-12 col-md-6 col-lg-4">
                                <div class="single-product-area mb-30">
                                    <div class="product_image">
                                        <!-- Product Image -->
                                        <img class="normal_img" src="{{$item->photo}}" alt="{{$item->title}}">
                                      

                                        <!-- Product Badge -->
                                        <div class="product_badge">
                                            <span>{{$item->conditions}}</span>
                                        </div>

                                        <!-- Wishlist -->
                                        <div class="product_wishlist">
                                            <a href="wishlist.html"><i class="icofont-heart"></i></a>
                                        </div>

                                        <!-- Compare -->
                                        <div class="product_compare">
                                            <a href="compare.html"><i class="icofont-exchange"></i></a>
                                        </div>
                                    </div>

                                    <!-- Product Description -->
                                    <div class="product_description">
                                        <!-- Add to cart -->
                                        <div class="product_add_to_cart">
                                            <a href="#"><i class="icofont-shopping-cart"></i> Add to Cart</a>
                                        </div>

                                        <!-- Quick View -->
                                        <div class="product_quick_view">
                                            <a href="#" data-toggle="modal" data-target="#quickview"><i class="icofont-eye-alt"></i> Quick View</a>
                                        </div>

                                        <p class="brand_name">{{\App\Models\Brand::where('id',$item->brand_id)->value('title')}}</p>
                                        <a href="{{ route('product.detail',$item->slug) }}">{{$item->title}}/a>
                                        <h6 class="product-price">{{number_format($item->offer_price,2)}} TK <span><del class="text-danger">{{number_format($item->price,2)}} TK</del></span></h6>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <p>No Product Found!</p>
                            @endif

                         
                        </div>
                    </div>
                    <!-- Shop Pagination Area 
                    Laravel defaulr Pagination{{$products->links()}}
                    -->
                    {{$products->appends($_GET)->links('vendor.pagination.custom')}}

                   

                </div>
            </div>
        </form>    
        </div>
    </section>

@endsection

@section('scripts')

<script>
$(document).ready(function(){
    if($('#slider-range').length > 0){
        const max_price=parseInt($('#slider-range').data('max'));
        const min_price=parseInt($('#slider-range').data('min')); 
        let price_range = min_price+'-'+max_price;
        //alert(price_range);
        if($('#price_range'.length>0) && $('#price_range').val()){
            price_range= $('#price_range').val().trim();
        }
        let price = price_range.split('-');
        $('#slider-range').slider({
            range:true;
            min:min_value,
            max:max_value,
            values:price,
            slide:function(event,ui){
                $('#amount').val('$'+ui.values[0]+"-"+"$"+ui.values[1]);
                $('#price_range').val(ui.values[0]+"-"+ui.values[1]);
            }

        });

    }
});
</script>

@endsection
