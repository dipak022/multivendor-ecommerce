@extends('backend.layouts.master')
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Create Product</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Create Product</li>
                        </ul>
                    </div> 
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                            <h3> Create Product </h3>
                        </div>
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                        <a class="btn btn-success" href="{{route('product.index')}}">All Product</a>
                        </div>
                    </div>           
                    
                </div>
            </div>

            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                        <form class="add-contact-form" method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                             @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter title" name="title" value="{{old('title')}}" />
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Stock" name="strock" value="{{old('strock')}}" />
                            </div>
                            <div class="form-group">
                                <input type="number" step="any" class="form-control" placeholder="Price" name="price" value="{{old('price')}}" />
                            </div>
                            <div class="form-group">
                                <input type="number" step="any" class="form-control" placeholder="Discount" name="discount" value="{{old('discount')}}" />
                            </div>
                            
                            <select class="form-control show-tick" name="brand_id">
                                <option selected disable>--Select Brands--</option>
                                @foreach(\App\Models\Brand::get() as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : ''}}>{{$brand->title}}</option>
                                @endforeach
                            </select>
                            </br>
                            <div class="" id="">
                                <select id="cat_id" class="form-control show-tick" name="cat_id">
                                    <option selected disable>--Select Categorys--</option>
                                    @foreach(\App\Models\Category::where('is_parent',1)->get() as $cat)
                                        <option value="{{ $cat->id }}" {{ old('cat_id') == $cat->id ? 'selected' : '' }}>{{$cat->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            </br>
                            <div class="d-none" id="child_cat_div">
                                <select id="child_cat_id" class="form-control show-tick" name="clild_cat_id ">
                                
                                </select>
                            </div>
                            </br>
                            
                            <select class="form-control show-tick" name="size">
                                <option selected disable>--Select Size--</option>
                                <option value="S" {{old("size") == "S" ? "selected" : "" }}>Small</option>
                                <option value="M" {{old("size") == "M" ? "selected" : "" }}>Medium</option>
                                <option value="L" {{old("size") == "L" ? "selected" : "" }}>Large</option>
                                <option value="XL" {{old("size") == "XL" ? "selected" : "" }}>Extra Large</option>
                            </select>
                            </br>
                            <select class="form-control show-tick" name="Conditions">
                                <option selected disable>--Select Conditions--</option>
                                <option value="new" {{old("conditions") == "new" ? "selected" : "" }}>New</option>
                                <option value="popular" {{old("conditions") == "popular" ? "selected" : "" }}>Popular</option>
                                <option value="winter" {{old("conditions") == "winter" ? "selected" : "" }}>Winter</option>
                            </select>
                            </br>
                            <!--
                            <select class="form-control show-tick" name="vandor_id">
                                <option selected disable>--Select Vendors--</option>
                                @foreach(\App\Models\User::where('role','seller')->get() as $vendor)
                                    <option value="{{ $vendor->id }}"  {{old('vandor_id') == $vendor->id ? 'selected' : '' }}>{{$vendor->full_name}}</option>
                                @endforeach
                            </select>
                            -->
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
                            <div class="form-group">
                                <textarea rows="3" class="form-control no-resize" placeholder="Enter here for tweet..." name="sammary">{{old('sammary')}}</textarea>
                            </div>
                            <div>
                            <textarea  class="summernote"  placeholder="write some text ..." name="description">{{old('description')}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary  m-t-20">Create Product</button>
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
$('#cat_id').change(function(){
    var cat_id = $(this).val();
    //alert(cat_id);
    if(cat_id !=null){
        $.ajax({
            url : "/admin/category/"+cat_id+"/child",
            type : "POST",
            data : {
                _token:'{{csrf_token()}}',
                //mode : mode,
                cat_id : cat_id,
            },
            success:function(response){
             //console.log(response);
             var html_option ="<option value=''>--Child Category--</option>";
             if(response.status){
                 $('#child_cat_div').removeClass('d-none');
                 $.each(response.data,function(id,title){
                     //alert(title);
                    html_option +="<option value ='"+id+"'>"+title+"</option>";

                 });
             }else{
                 //alert("Not Found Child Category");
                 $('#child_cat_div').addClass('d-none');
             }
             //append option 
             $('#child_cat_id').html(html_option);
            }
        });
    }

});
</script>
@endsection