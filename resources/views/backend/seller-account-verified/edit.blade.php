@extends('backend.layouts.master')
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Edit User</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Edit User</li>
                        </ul>
                    </div>            
                   
                </div>
            </div>

            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                        <form class="add-contact-form" method="post" action="{{ route('user.update',$user->id) }}" enctype="multipart/form-data">
                             @csrf
                             @method('patch')
                             <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter Full name" name="full_name" value="{{ $user->full_name }}" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter User name" name="username" value="{{ $user->username }}" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Enter Email" name="email" value="{{ $user->email}}" />
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Enter phone" name="phone" value="{{ $user->phone }}" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter address" name="address" value="{{ $user->address }}" />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Enter password" name="password" value="{{ $user->password }}" />
                            </div>
                            <select class="form-control show-tick" name="role">
                                <option selected disable>--Select Role--</option>
                                <option value="admin" {{ $user->role == "admin" ? "selected" : "" }}>Admin</option>
                                <option value="customer" {{ $user->role == "customer" ? "selected" : "" }}>Customer</option>
                                <option value="vendor" {{ $user->role == "vendor" ? "selected" : "" }}>Vendor</option>
                            </select>
                            </br>
                            <select class="form-control show-tick" name="status">
                                <option selected disable>--Select Status--</option>
                                <option value="active" {{ $user->status == "active" ? "selected" : "" }}>Active</option>
                                <option value="inactive" {{$user->status == "inactive" ? "selected" : "" }}>Inactive</option>
                            </select>

                            <div class="form-group m-t-20 m-b-20">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                <input id="thumbnail" class="form-control" type="text" name="photo" value={{$user->photo}}>
                                </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                               
                            </div>
                            <button type="submit" class="btn btn-block btn-primary  m-t-20">Update User</button>
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