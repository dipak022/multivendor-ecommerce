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
                    <input type="hidden"  data-id="{{ $item->rowId }}" data-product-quantity="{{ $item->model->strock }}" id="updates-cart-{{ $item->rowId }}" >
                </div>
            </td>
            <td>{{ number_format($item->price*$item->qty,2) }} TK</td>
        </tr>
    @endforeach
    
</tbody>
</table>