@extends('backend.layouts.master')
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Create Category</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Create Category</li>
                        </ul>
                    </div>            
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                            <div class="sparkline text-left" data-type="line" data-width="8em" data-height="20px" data-line-Width="1" data-line-Color="#00c5dc"
                                data-fill-Color="transparent">3,5,1,6,5,4,8,3</div>
                            <span>Visitors</span>
                        </div>
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                            <div class="sparkline text-left" data-type="line" data-width="8em" data-height="20px" data-line-Width="1" data-line-Color="#f4516c"
                                data-fill-Color="transparent">4,6,3,2,5,6,5,4</div>
                            <span>Visits</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                        <form class="add-contact-form" method="post" action="{{ route('banner.store') }}" enctype="multipart/form-data">
                             @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter Blog title" name="title" value="{{old('title')}}" />
                            </div>
                            <select class="form-control show-tick" name="condition">
                                <option selected disable>-Select Condition--</option>
                                <option value="banner" {{old("condition") == "banner" ? "selected" : "" }}>Banner</option>
                                <option value="promo" {{old("condition") == "promo" ? "selected" : "" }}>Promote</option>
                               
                            </select>
                            </br>
                            <select class="form-control show-tick" name="status">
                                <option selected disable>--Select Status--</option>
                                <option value="active" {{old("status") == "active" ? "selected" : "" }}>Active</option>
                                <option value="inactive" {{old("status") == "inactive" ? "selected" : "" }}>Inactive</option>
                               
                            </select>
                            <div class="form-group m-t-20 m-b-20">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                <input id="thumbnail" class="form-control" type="text" name="photo">
                                </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                               
                            </div>
                            
                            <div>
                            <textarea  class="summernote" name="product_details" placeholder="write some text ..." name="description">{{old('description')}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary  m-t-20">Create Category</button>
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