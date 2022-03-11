@extends('backend.layouts.master')
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Edit Category</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Edit Category</li>
                        </ul>
                    </div>            
                   
                </div>
            </div>

            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                        <form class="add-contact-form" method="post" action="{{ route('category.update',$category->id) }}" enctype="multipart/form-data">
                             @csrf
                             @method('patch')
                             <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter title" name="title" value="{{$category->title}}" />
                            </div>

                            <div class="form-group" >
                            <div class="form-group">
                                    <label mx-5>Is Parent</label>
                                    
                                    <label class="fancy-checkbox" mz-5>
                                        <input type="checkbox" value="{{$category->is_parent}}" {{$category->is_parent == 1 ? 'checked' : ''}} id="is_parent" name="is_parent"  required data-parsley-errors-container="#error-checkbox">
                                        <span>Yes</span>
                                    </label>
                                   
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-md-12 col-sm-12 form-group {{$category->is_parent == 1 ? 'd-none' : ''}}" id="parent_cat_div">
                                <label mx-5>Is Parent</label>
                                <select class="form-control show-tick" name="parent_id">
                                    <option  disable value="">Select Category</option>
                                    @foreach($parant_category as $row)
                                    <option  value="{{ $row->id }}" {{ $row->id == $category->parent_id ? 'selected' : ''}}>{{ $row->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br/>
                            <select class="form-control show-tick" name="status">
                                <option selected disable>--Select Status--</option>
                                <option value="active" {{$category->status == "active" ? "selected" : "" }}>Active</option>
                                <option value="inactive" {{$category->status == "inactive" ? "selected" : "" }}>Inactive</option>
                            </select>

                            <div class="form-group m-t-20 m-b-20">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$category->photo}}">
                                </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                               
                            </div>
                            
                            <div>
                            <textarea  class="summernote"  placeholder="write some text ..." name="summary">{{$category->summary}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary  m-t-20">Update Category</button>
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

<script>
$('#is_parent').change(function(e){
    e.preventDefault();
    var is_checked = $('#is_parent').prop('checked');
    //alert(is_checked);
    if(is_checked){
        $('#parent_cat_div').addClass('d-none');
        $('#parent_cat_div').val('');
    }else{
        $('#parent_cat_div').removeClass('d-none');
    }

});
</script>
@endsection