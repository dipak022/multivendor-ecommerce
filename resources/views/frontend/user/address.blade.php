@extends('frontend.layouts.master')

@section('content')
 
 <!-- Breadcumb Area -->
 <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>My Account</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">My Account</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- My Account Area -->
    <section class="my-account-area section_padding_100_50">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <div class="my-account-navigation mb-50">
                       @include('frontend.user.sidebar')
                    </div>
                </div>
                <div class="col-12 col-lg-9">
                    <div class="my-account-content mb-50">
                        <p>The following addresses will be used on the checkout page by default.</p>

                        <div class="row">
                            <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                                <h6 class="mb-3">Billing Address</h6>
                                <address>
                                    {{$user->address}} <br>
                                    {{$user->state}},  {{$user->city}} <br>
                                    {{$user->country}} <br>
                                    {{$user->postcode}}
                                </address>
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editAddress">Edit Address</a>
                                <!-- Address modal -->
                              
                                <div class="modal fade" id="editAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="false" style="background:rgba(0,0,0,0.5);">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Address</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('billing.address',$user->id) }}" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                    <div class="form-group">
                                                        <level for="">Address</level>
                                                        <textarea  type="text" class="form-control" name="address" placeholder="Enter your address" >{{ $user->address }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <level for="">Country</level>
                                                        <input type="text" class="form-control" name="country" placeholder="Enter your country">{{ $user->country }}</input>
                                                    </div>
                                                    <div class="form-group">
                                                        <level for="">Postcode</level>
                                                        <input  type="number" class="form-control" name="postcode" placeholder="Enter your postcode">{{ $user->postcode }}</input>
                                                    </div>
                                                    <div class="form-group">
                                                        <level for="">State</level>
                                                        <input type="text" class="form-control" name="state" placeholder="Enter your state">{{ $user->state }}</input>
                                                    </div>
                                                    <div class="form-group">
                                                        <level for="">City</level>
                                                        <input type="text" class="form-control" name="city" placeholder="Enter your city">{{ $user->city }}</input>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update Address</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                                 <!-- Modal -->
                            </div>
                            <div class="col-12 col-lg-6">
                                <h6 class="mb-3">Shipping Address</h6>
                                <address>
                                    You have not set up this type of address yet.
                                </address>
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#shipingAddress">Edit Address</a>
                                <!-- Shipping Address modal -->
                              
                                <div class="modal fade" id="shipingAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="false" style="background:rgba(0,0,0,0.5);">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Shipping Address</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="">
                                        <div class="modal-body">
                                                <div class="form-group">
                                                    <level for="">Shipping Address</level>
                                                    <textarea type="text" class="form-control" name="saddress" placeholder="Enter your Shipping address" >{{ $user->saddress }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <level for="">Shipping Country</level>
                                                    <input type="text" class="form-control" name="scountry" placeholder="Enter your Shipping country">{{ $user->scountry }}</input>
                                                </div>
                                                <div class="form-group">
                                                    <level for="">Shipping Postcode</level>
                                                    <input type="number" class="form-control" name="spostcode" placeholder="Enter your Shipping postcode">{{ $user->spostcode }}</input>
                                                </div>
                                                <div class="form-group">
                                                    <level for="">Shipping State</level>
                                                    <input type="text" class="form-control" name="sstate" placeholder="Enter your Shipping state">{{ $user->sstate }}</input>
                                                </div>
                                                <div class="form-group">
                                                    <level for="">Shipping City</level>
                                                    <input type="text" class="form-control" name="scity" placeholder="Enter your Shipping city">{{ $user->scity }}</input>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update Shipping Address</button>
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                                 <!-- Modal -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- My Account Area -->

@endsection   
@section('styles')
<style>
.footer_area{
    z-index:-1;
}
</style>

@endsection  
