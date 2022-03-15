@extends('frontend.layouts.master')

@section('content')

 <!-- Breadcumb Area -->
 <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Wishlist</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Wishlist</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Wishlist Table Area -->
    <div class="wishlist-table section_padding_100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cart-table wishlist-table">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-30">
                                <thead>
                                    <tr>
                                        <th scope="col"><i class="icofont-ui-delete"></i></th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Unit Price</th>
                                        <!--
                                        <th scope="col">Quantity</th>
                                        -->
                                        <th scope="col">Favorite List Add To Cart</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->count())
                                        @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->content() as $item)
                                            <tr>
                                                <th scope="row">
                                                    <i class="icofont-close"></i>
                                                </th>
                                                <td>
                                                    <img src="{{$item->model->photo}}" alt="{{ $item->model->slug }}">
                                                </td>
                                                <td>
                                                    <a href="{{ route('product.detail',$item->model->slug) }}">{{$item->name}}</a>
                                                </td>
                                                <td>{{ number_format($item->price,2) }} TK</td>
                                                <!--
                                                <td>
                                                    <div class="quantity">
                                                        <input type="number" class="qty-text" id="qty2" step="1" min="1" max="99" name="quantity" value="1">
                                                    </div>
                                                </td>
                                                -->
                                                <td><a href="javascript:void(0)" data-id="{{ $item->rowId }}" class="move-to-cart btn btn-primary btn-sm">Add to Cart</a></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <p>You don't have any wishlist product!!</p>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--
                    <div class="cart-footer text-right">
                        <div class="back-to-shop">
                            <a href="#" class="btn btn-primary">Add All Item</a>
                        </div>
                    </div>
                    -->
                </div>
            </div>
        </div>
    </div>
    <!-- Wishlist Table Area -->


@endsection

@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  

@endsection