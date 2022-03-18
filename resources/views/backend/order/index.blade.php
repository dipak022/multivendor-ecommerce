@extends('backend.layouts.master')
@section('content')
 
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Order Management List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Order</li>
                            <li class="breadcrumb-item active">Order Management</li>
                        </ul>
                    </div>            
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                            <h3 > Total Order List :{{\App\Models\Order::count()}} </h3>
                        </div>
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                        <a class="btn btn-success" href="{{route('order.index')}}">View All Order</a>
                        </div>
                    </div>
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
                                        <th>S.N.</th>
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
                                    @foreach($orders as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->first_name}} {{$item->last_name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->payment_method}}</td>
                                        <td>
                                            @if($item->payment_status === 'paid')
                                            <span class="badge badge-success">{{$item->payment_status}}</span>
                                            @else
                                            <span class="badge badge-dander">{{$item->payment_status}}</span>
                                            @endif
                                        </td>
                                        <td>{{$item->total_amount}}</td>
                                        <td>
                                            @if($item->condition === 'pending')
                                            <span class="badge badge-success">{{$item->condition}}</span>
                                            @elseif($item->condition === 'processing')
                                            <span class="badge badge-primary">{{$item->condition}}</span>
                                            @elseif($item->condition === 'delivered')
                                            <span class="badge badge-info">{{$item->condition}}</span>
                                            @else
                                            <span class="badge badge-dander">{{$item->condition}}</span>
                                            @endif
                                        </td>
                                     
                                        <td>
                                            <a type="button" href="{{route('order.show',$item->id)}}" class="btn btn-info" title="Edit"><i class="float-left fa fa-eye"></i></a>
                                            <form class="float-left px-2" action="{{ route('order.destroy',$item->id) }}" method="POST">
                                                @csrf 
                                                @method('delete')
                                                <a type="button" data-type="confirm" class="dltBtn btn btn-danger js-sweetalert " title="Delete"><i class="float-left fa fa-trash-o"></i></a>

                                            </form>
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                  
                                   
                                </tbody>
                            </table>
							</div>
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
        })
        
        

    });

</script>




@endsection