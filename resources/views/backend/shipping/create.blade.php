@extends('backend.layouts.master')
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Create Shipping</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Create Shipping</li>
                        </ul>
                    </div> 
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                            <h3 > Create Shipping </h3>
                        </div>
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                        <a class="btn btn-success" href="{{route('shipping.index')}}">All Shipping</a>
                        </div>
                    </div>           
                    
                </div>
            </div>

            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                        <form class="add-contact-form" method="post" action="{{ route('shipping.store') }}" enctype="multipart/form-data">
                             @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter shipping address" name="shipping_address" value="{{old('shipping_address')}}" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter delivery time" name="delivery_time" value="{{old('delivery_time')}}" />
                            </div>
                            <div class="form-group">
                                <input type="number" step="any" class="form-control" placeholder="Enter delivery charge" name="delivery_charge" value="{{old('delivery_charge')}}" />
                            </div>
                         
                            <select class="form-control show-tick" name="status">
                                <option selected disable>--Select Status--</option>
                                <option value="active" {{old("status") == "active" ? "selected" : "" }}>Active</option>
                                <option value="inactive" {{old("status") == "inactive" ? "selected" : "" }}>Inactive</option>
                               
                            </select>
                            
                            <button type="submit" class="btn btn-block btn-primary  m-t-20">Create Shipping</button>
                           </div>
                         </form>
                    </div>
                </div>            
            </div>

        </div>
    </div>
@endsection

@section('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
$('#lfm').filemanager('image');
</script>>
@endsection