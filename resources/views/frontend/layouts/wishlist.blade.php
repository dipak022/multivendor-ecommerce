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
                    <i class="icofont-close delete_wishlist" data-id="{{ $item->rowId }}"></i>
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
        <tr>
          <td colspan="5" class="text-center">You don't have any wishlist product!!</td>
        </tr>
    @endif
</tbody>
</table>