@extends('seller.layouts.master')
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Edit Product</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('seller')}}"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Edit Product</li>
                        </ul>
                    </div>            
                   
                </div>
            </div>

            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                        <form class="add-contact-form" method="post" action="{{ route('seller_product.update',$product->id) }}" enctype="multipart/form-data">
                             @csrf
                             @method('patch')
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter title" name="title" value="{{ $product->title }}" />
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Stock" name="strock" value="{{ $product->strock }}" />
                            </div>
                            <div class="form-group">
                                <input type="number" step="any" class="form-control" placeholder="Price" name="price" value="{{ $product->price }}" />
                            </div>
                            
                            <div class="form-group">
                                <input type="number" step="any" class="form-control" placeholder="Discount" name="discount" value="{{ $product->discount }}" />
                            </div>
                            <select class="form-control show-tick" name="brand_id">
                                <option selected disable>--Select Brands--</option>
                                @foreach(\App\Models\Brand::get() as $brand)
                                    <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>{{$brand->title}}</option>
                                @endforeach
                            </select>
                            </br>
                            <div class="" id="">
                                <select id="cat_id" class="form-control show-tick" name="cat_id">
                                    <option selected disable>--Select Categorys--</option>
                                    @foreach(\App\Models\Category::where('is_parent',1)->get() as $cat)
                                        <option value="{{ $cat->id }}" {{ $cat->id == $product->cat_id ? 'selected' : '' }}>{{$cat->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            </br>
                            <div class="d-none" id="child_cat_div">
                                <select id="child_cat_id" class="form-control show-tick" name="clild_cat_id">
                                    
                                   
                                </select>
                            </div>
                            </br>
                            
                            <select class="form-control show-tick" name="size">
                                <option selected disable>--Select Size--</option>
                                <option value="S" {{ $product->size == "S" ? "selected" : "" }}>Small</option>
                                <option value="M" {{ $product->size == "M" ? "selected" : "" }}>Medium</option>
                                <option value="L" {{ $product->size == "L" ? "selected" : "" }}>Large</option>
                                <option value="XL" {{ $product->size == "XL" ? "selected" : "" }}>Extra Large</option>
                            </select>
                            </br>
                            <select class="form-control show-tick" name="Conditions">
                                <option selected disable>--Select Conditions--</option>
                                <option value="new" {{ $product->conditions == "new" ? "selected" : "" }}>New</option>
                                <option value="popular" {{ $product->conditions == "popular" ? "selected" : "" }}>Popular</option>
                                <option value="winter" {{ $product->conditions == "winter" ? "selected" : "" }}>Winter</option>
                            </select>
                            </br>
                            <!--
                            <select class="form-control show-tick" name="vandor_id">
                                <option selected disable>--Select Vendors--</option>
                                @foreach(\App\Models\User::where('role','seller')->get() as $vendor)
                                    <option value="{{ $vendor->id }}" {{ $vendor->id == $product->vandor_id ? 'selected' : '' }} >{{$vendor->full_name}}</option>
                                @endforeach
                            </select>
                            -->
                            </br>
                            <select class="form-control show-tick" name="status">
                                <option selected disable>--Select Status--</option>
                                <option value="active" {{ $product->status == "active" ? "selected" : "" }}>Active</option>
                                <option value="inactive" {{ $product->status == "inactive" ? "selected" : "" }}>Inactive</option>
                               
                            </select>
                            <div class="form-group m-t-20 m-b-20">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                <input id="thumbnail" class="form-control" type="text" name="photo" value="{{ $product->photo }}">
                                </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                               
                            </div>
                            <div class="form-group">
                                <textarea rows="3" class="form-control no-resize" placeholder="Enter here for tweet..." name="sammary">{{ $product->sammary }}</textarea>
                            </div>
                            <div>
                            <textarea  class="summernote"  placeholder="write some text ..." name="description">{{ $product->description }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary  m-t-20">Update Product</button>
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
var child_cat_id = {{$product->clild_cat_id}}
//alert(child_cat_id);
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
                    html_option +="<option value ='"+id+"' "+(child_cat_id==id ? 'selected' : '' )+">"+title+"</option>";

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
if(child_cat_id !=null){
    $('#cat_id').change();
}
</script>
@endsection