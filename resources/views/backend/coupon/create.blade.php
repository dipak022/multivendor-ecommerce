@extends('backend.layouts.master')
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Create Coupon</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Create Coupon</li>
                        </ul>
                    </div> 
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                            <h3 > Create Coupon </h3>
                        </div>
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                        <a class="btn btn-success" href="{{route('coupon.index')}}">All Coupon</a>
                        </div>
                    </div>           
                    
                </div>
            </div>

            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                        <form class="add-contact-form" method="post" action="{{ route('coupon.store') }}" enctype="multipart/form-data">
                             @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter coupon code" name="code" value="{{old('code')}}" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter coupon value" name="value" value="{{old('value')}}" />
                            </div>
                            <select class="form-control show-tick" name="type">
                                <option selected disable>-Select Type--</option>
                                <option value="fixed" {{old("type") == "fixed" ? "selected" : "" }}>Fixed</option>
                                <option value="percent" {{old("type") == "percent" ? "selected" : "" }}>Percentage</option>
                               
                            </select>
                            </br>
                            <select class="form-control show-tick" name="status">
                                <option selected disable>--Select Status--</option>
                                <option value="active" {{old("status") == "active" ? "selected" : "" }}>Active</option>
                                <option value="inactive" {{old("status") == "inactive" ? "selected" : "" }}>Inactive</option>
                               
                            </select>
                            
                            <button type="submit" class="btn btn-block btn-primary  m-t-20">Create Coupon</button>
                           </div>
                         </form>
                    </div>
                </div>            
            </div>

        </div>
    </div>
@endsection

@section('scripts')

@endsection