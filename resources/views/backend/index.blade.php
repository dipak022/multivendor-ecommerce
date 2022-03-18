@extends('backend.layouts.master')
@section('content')
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Dashboard</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>            
                   
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card overflowhidden number-chart">
                        <div class="body">
                            <div class="number">
                                <h6>Total Category</h6>
                                <span>{{\App\Models\Category::where('status','active')->count()}} Categorys</span>
                            </div>
                           
                        </div>
                        <div class="sparkline" data-type="line" data-spot-Radius="0" data-offset="90" data-width="100%" data-height="50px"
                        data-line-Width="1" data-line-Color="#f79647" data-fill-Color="#fac091">1,4,1,3,7,1</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card overflowhidden number-chart">
                        <div class="body">
                            <div class="number">
                                 <h6>Total Product</h6>
                                <span>{{\App\Models\Product::where('status','active')->count()}} Products</span>
                            </div>
                         
                        </div>
                        <div class="sparkline" data-type="line" data-spot-Radius="0" data-offset="90" data-width="100%" data-height="50px"
                        data-line-Width="1" data-line-Color="#604a7b" data-fill-Color="#a092b0">1,4,2,3,6,2</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card overflowhidden number-chart">
                        <div class="body">
                            <div class="number">
                            <h6>New Customer</h6>
                                <span>{{\App\Models\User::where('status','active')->count()}} Products</span>
                            </div>
                           
                        </div>
                        <div class="sparkline" data-type="line" data-spot-Radius="0" data-offset="90" data-width="100%" data-height="50px"
                        data-line-Width="1" data-line-Color="#4aacc5" data-fill-Color="#92cddc">1,4,2,3,1,5</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card overflowhidden number-chart">
                        <div class="body">
                            <div class="number">
                                <h6>LIKES</h6>
                                <span>$421,215</span>
                            </div>
                            <small class="text-muted">19% compared to last week</small>
                        </div>
                        <div class="sparkline" data-type="line" data-spot-Radius="0" data-offset="90" data-width="100%" data-height="50px"
                        data-line-Width="1" data-line-Color="#4f81bc" data-fill-Color="#95b3d7">1,3,5,1,4,2</div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Top Products</h2>
                            <ul class="header-dropdown">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="chart-top-products" class="chartist"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="header">
                            <h2>Referrals</h2>
                            <ul class="header-dropdown">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <ul class="list-unstyled list-referrals">
                                <li>
                                    <p><span class="value">2301</span><span class="text-muted float-right">visits from Facebook</span></p>
                                    <div class="progress progress-xs progress-transparent custom-color-blue">
                                        <div class="progress-bar" data-transitiongoal="87"></div>
                                    </div>
                                </li>
                                <li>
                                    <p><span class="value">2107</span><span class="text-muted float-right">visits from Twitter</span></p>
                                    <div class="progress progress-xs progress-transparent custom-color-purple">
                                        <div class="progress-bar" data-transitiongoal="34"></div>
                                    </div>
                                </li>                                
                                <li>
                                    <p><span class="value">2308</span><span class="text-muted float-right">visits from Search</span></p>
                                    <div class="progress progress-xs progress-transparent custom-color-yellow">
                                        <div class="progress-bar" data-transitiongoal="54"></div>
                                    </div>
                                </li>
                                <li>
                                    <p><span class="value">1024</span><span class="text-muted float-right">visits from Affiliates</span></p>
                                    <div class="progress progress-xs progress-transparent custom-color-green">
                                        <div class="progress-bar" data-transitiongoal="67"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="header">
                            <h2>Total Revenue</h2>
                            <ul class="header-dropdown">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body text-center">
                            <h4 class="margin-0">Total Sale</h4>
                            <h6 class="m-b-20">2,45,124</h6>
                            <input type="text" class="knob" value="63" data-width="100" data-height="100" data-thickness="0.25" data-angleArc="250" data-angleoffset="-125" data-fgColor="#212121" readonly>                            
                            <div class="sparkline" data-type="bar" data-width="97%" data-height="26px" data-bar-Width="6" data-bar-Spacing="6" data-bar-Color="#7460ee">2,5,4,8,3,9,1,5</div>
                            <h6 class="p-b-15">Weekly Earnings</h6>
                            <div class="sparkline" data-type="bar" data-width="97%" data-height="26px" data-bar-Width="2" data-bar-Spacing="4" data-bar-Color="#11a0f8">3,1,5,4,7,8,2,3,1,4,6,5,4,4,2,3,1,5,4,7,8,2,3,1,4,6,5,4,4,2</div>
                            <h6>Monthly Earnings</h6>
                        </div>
                    </div>
                </div>
            </div>
            <!--
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Resent Chat</h2>
                            <ul class="header-dropdown">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body text-center">
                            <div class="cwidget-scroll">
                                <ul class="chat-widget m-r-5 clearfix">
                                    <li class="left float-left">
                                        <img src="{{asset('backend/')}}/assets/images/xs/avatar2.jpg" class="rounded-circle" alt="">
                                        <div class="chat-info">       
                                            <span class="message">Hello, John<br>What is the update on Project X?</span>
                                        </div>
                                    </li>
                                    <li class="right">
                                        <img src="{{asset('backend/')}}/assets/images/xs/avatar1.jpg" class="rounded-circle" alt="">
                                        <div class="chat-info">
                                            <span class="message">Hi, Alizee<br> It is almost completed. I will send you an email later today.</span>
                                        </div>
                                    </li>
                                    <li class="left float-left">
                                        <img src="{{asset('backend/')}}/assets/images/xs/avatar2.jpg" class="rounded-circle" alt="">
                                        <div class="chat-info">
                                            <span class="message">That's great. Will catch you in evening.</span>
                                        </div>
                                    </li>
                                    <li class="right">
                                        <img src="{{asset('backend/')}}/assets/images/xs/avatar1.jpg" class="rounded-circle" alt="">
                                        <div class="chat-info">
                                            <span class="message">Sure we'will have a blast today.</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="input-group p-t-15">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="icon-paper-plane"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Enter text here...">                                    
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Data Managed</h2>
                            <ul class="header-dropdown">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2>1,523</h2>
                                    <p>External Records</p>                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="sparkline m-b-20" data-type="bar" data-width="97%" data-height="60px" data-bar-Width="3" data-bar-Spacing="8" data-bar-Color="#00ced1">2,-1,5,6,4,8,7,-5,6,2,3,5,6,2,-3,4,-2</div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover m-b-0">
                                    <tbody>
                                        <tr>
                                            <th><i class="fa fa-circle text-success"></i></th>
                                            <td>Twitter</td>
                                            <td><span>862 Records</span></td>
                                            <td>35% <i class="fa fa-caret-up "></i></td>
                                        </tr>
                                        <tr>
                                            <th><i class="fa fa-circle text-info"></i></th>
                                            <td>Facebook</td>
                                            <td><span>451 Records</span></td>
                                            <td>15% <i class="fa fa-caret-up "></i></td>
                                        </tr>
                                        <tr>
                                            <th><i class="fa fa-circle text-warning"></i></th>
                                            <td>Mailchimp</td>
                                            <td><span>502 Records</span></td>
                                            <td>20% <i class="fa fa-caret-down"></i></td>
                                        </tr>
                                        <tr>
                                            <th><i class="fa fa-circle text-danger"></i></th>
                                            <td>Google</td>
                                            <td><span>502 Records</span></td>
                                            <td>20% <i class="fa fa-caret-up "></i></td>
                                        </tr>
                                        <tr>
                                            <th><i class="fa fa-circle "></i></th>
                                            <td>Other</td>
                                            <td><span>237 Records</span></td>
                                            <td>10% <i class="fa fa-caret-down"></i></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
            -->
            

        </div>
    </div>
@endsection