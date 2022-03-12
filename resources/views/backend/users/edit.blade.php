@extends('backend.layouts.master')
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Edit Brand</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Edit Brand</li>
                        </ul>
                    </div>            
                   
                </div>
            </div>

            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                        <form class="add-contact-form" method="post" action="{{ route('brand.update',$brand->id) }}" enctype="multipart/form-data">
                             @csrf
                             @method('patch')
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter title" name="title" value="{{$brand->title}}" />
                            </div>
                            
                            <select class="form-control show-tick" name="status">
                                <option selected disable>--Select Status--</option>
                                <option value="active" {{ $brand->status == "active" ? "selected" : "" }}>Active</option>
                                <option value="inactive" {{ $brand->status == "inactive" ? "selected" : "" }}>Inactive</option>
                               
                            </select>
                            <div class="form-group m-t-20 m-b-20">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                <input id="thumbnail" class="form-control" type="text" name="photo" value={{$brand->photo}}>
                                </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary  m-t-20">Update Brand</button>
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