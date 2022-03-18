@extends('backend.layouts.master')
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> seeting</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Home</li>
                            
                        </ul>
                    </div> 
                             
                    
                </div>
            </div>

            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                        <form class="add-contact-form" method="post" action="{{ route('seeting.update',$seeting->id) }}" enctype="multipart/form-data">
                             @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter title" name="title" value="{{$seeting->title}}" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter 	meta description" name="meta_description" value="{{$seeting->meta_description}}" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter 	meta keywords" name="meta_keywords" value="{{$seeting->meta_keywords}}" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter address" name="address" value="{{$seeting->address}}" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Enter email" name="email" value="{{$seeting->email}}" />
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Enter phone" name="phone" value="{{$seeting->phone}}" />
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Enter fax" name="fax" value="{{$seeting->fax}}" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter footer" name="footer" value="{{$seeting->footer}}" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter facebook url" name="facebook_url" value="{{$seeting->facebook_url}}" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter twitter url" name="twitter_url" value="{{$seeting->twitter_url}}" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter linkedin url" name="linkedin_url" value="{{$seeting->linkedin_url}}" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter plaintext" name="plaintext" value="{{$seeting->plaintext}}" />
                            </div>
                            	
                            
                           
                           
                            <div class="form-group m-t-20 m-b-20">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                <input id="thumbnail" class="form-control" type="text" name="logo">
                                </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                            </div>

                            <div class="form-group m-t-20 m-b-20">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                <input id="thumbnail" class="form-control" type="text" name="favicon">
                                </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                            </div>
                            
                            
                            <button type="submit" class="btn btn-block btn-primary  m-t-20">Update Seeting</button>
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