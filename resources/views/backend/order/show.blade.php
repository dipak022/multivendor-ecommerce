@extends('backend.layouts.master')
@section('content')
 
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    
                </div>
            </div>
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Order Information List </h2>                            
                        </div>
                        <div class="body">
						    <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                      
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                               
                                <tbody>
                             
                                    <tr>
                                       
                                        <td>{{$order->first_name}} {{$order->last_name}}</td>
                                        <td>{{$order->email}}</td>
                                        <td>{{$order->payment_method}}</td>
                                        <td>
                                            @if($order->payment_status === 'paid')
                                            <span class="badge badge-success">{{$order->payment_status}}</span>
                                            @else
                                            <span class="badge badge-dander">{{$order->payment_status}}</span>
                                            @endif
                                        </td>
                                        <td>{{$order->total_amount}}</td>
                                        <td>
                                            @if($order->condition === 'pending')
                                            <span class="badge badge-success">{{$order->condition}}</span>
                                            @elseif($order->condition === 'processing')
                                            <span class="badge badge-primary">{{$order->condition}}</span>
                                            @elseif($order->condition === 'delivered')
                                            <span class="badge badge-info">{{$order->condition}}</span>
                                            @else
                                            <span class="badge badge-dander">{{$order->condition}}</span>
                                            @endif
                                        </td>
                                     
                                        <td>
                                            <a type="button" href="{{route('order.show',$order->id)}}" class="btn btn-info" title="Edit"><i class="float-left fa fa-download"></i></a>
                                            <form class="float-left px-2" action="{{ route('order.destroy',$order->id) }}" method="POST">
                                                @csrf 
                                                @method('delete')
                                                <a type="button" data-type="confirm" class="dltBtn btn btn-danger js-sweetalert " title="Delete"><i class="float-left fa fa-trash-o"></i></a>

                                            </form>
                                            
                                        </td>
                                    </tr>
                                 
                                  
                                   
                                </tbody>
                            </table>



                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Quantity </th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                               
                                <tbody>
                                    @foreach($order->products as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>  
                                        <td>
                                        <img src="{{$item->photo}}" id="holder" style="margin-top:15px;max-height:100px;"></img>
                                        </td>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->pivot->quantity}}</td>
                                        <td>{{number_format($item->price,2)}} TK</td>
                                    </tr>
                                    @endforeach
                                 
                                  
                                   
                                </tbody>
                            </table>
                
							</div>
                        </div>
                        <div class="row">
                            <div class="col-6">

                            </div>
                            <div class="col-5 border py-3">
                               <p>
                                    <strong>Sub Total :</strong>{{  $order->sub_total  }} Tk
                               </p>
                               @if($order->delivery_charge>0)
                               <p>
                                    <strong>Shiping Cost :</strong>{{  $order->delivery_charge  }} Tk
                               </p>
                               @endif
                               @if($order->coupon>0)
                               <p>
                                    <strong>Coupon :</strong>{{  $order->coupon  }} Tk
                               </p>
                               @endif
                               <p>
                                    <strong>Total :</strong>{{  $order->total_amount  }} Tk
                               </p>
                               <form action="{{route('order.status')}}" method="post">
                                   @csrf
                                   <input type="hidden" name="order_id" value={{$order->id}}>
                                   <strong>Status</strong>
                                   <select name="condition" class="form-control" id="">
                                       <option value="pending" {{ $order->condition == 'delivered' ||  $order->condition == 'cancelled' ? 'disabled' : '' }} {{ $order->condition == 'pending' ? 'selected' : '' }}>Pending</option>
                                       <option value="processing" {{ $order->condition == 'delivered' ||  $order->condition == 'cancelled' ? 'disabled' : '' }} {{ $order->condition == 'processing' ? 'selected' : '' }}>Processing</option>
                                       <option value="delivered" {{ $order->condition == 'cancelled' ? 'disabled' : '' }} {{ $order->condition == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                       <option value="cancelled" {{ $order->condition == 'delivered' ? 'disabled' : '' }} {{ $order->condition == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                   </select>
                                   <br/>
                                   <button type="submit" class="btn btn-sm btn-success">Update Status</button>

                               </form>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                </div>
            </div>

           

        </div>
    </div>
@endsection

@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $('.dltBtn').click(function(e){
       
        var form = $(this).closest('form');
        var dataId = $(this).data('id');
        e.preventDefault();
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
            Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
        }
        });
        
        

    });

</script>




@endsection