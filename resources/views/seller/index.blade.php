@extends('seller.layouts.master')
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Dashboard</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('seller')}}"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>            
                   
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card overflowhidden number-chart">
                        <div class="body">
                            <div class="number">
                                <h6>Total Category</h6>
                                <span>{{\App\Models\Category::where('status','active')->count()}} Categorys</span>
                            </div>
                           
                        </div>
                        <div class="sparkline" data-type="line" data-spot-Radius="0" data-offset="90" data-width="100%" data-height="50px"
                        data-line-Width="1" data-line-Color="#f79647" data-fill-Color="#fac091">1,4,1,3,7,1</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card overflowhidden number-chart">
                        <div class="body">
                            <div class="number">
                                 <h6>Total Product</h6>
                                <span>{{\App\Models\Product::where('status','active')->count()}} Products</span>
                            </div>
                         
                        </div>
                        <div class="sparkline" data-type="line" data-spot-Radius="0" data-offset="90" data-width="100%" data-height="50px"
                        data-line-Width="1" data-line-Color="#604a7b" data-fill-Color="#a092b0">1,4,2,3,6,2</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card overflowhidden number-chart">
                        <div class="body">
                            <div class="number">
                            <h6>New Customer</h6>
                                <span>{{\App\Models\User::where('status','active')->count()}} Products</span>
                            </div>
                           
                        </div>
                        <div class="sparkline" data-type="line" data-spot-Radius="0" data-offset="90" data-width="100%" data-height="50px"
                        data-line-Width="1" data-line-Color="#4aacc5" data-fill-Color="#92cddc">1,4,2,3,1,5</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card overflowhidden number-chart">
                        <div class="body">
                            <div class="number">
                                <h6>Profit</h6>
                                <span>0 TK</span>
                            </div>
                           
                        </div>
                        <div class="sparkline" data-type="line" data-spot-Radius="0" data-offset="90" data-width="100%" data-height="50px"
                        data-line-Width="1" data-line-Color="#4f81bc" data-fill-Color="#95b3d7">1,3,5,1,4,2</div>
                    </div>
                </div>
            </div>

        
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Order List</h2>
                       
                    </div>            
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                            <h3 > Total Order :{{\App\Models\Order::count()}} </h3>
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
                                            <a type="button" href="{{route('banner.edit',$item->id)}}" class="btn btn-info" title="Edit"><i class="float-left fa fa-eye"></i></a>
                                            <form class="float-left px-2" action="{{ route('banner.destroy',$item->id) }}" method="POST">
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
       
            

        </div>
    </div>
@endsection