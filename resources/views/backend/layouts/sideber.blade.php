<div id="left-sidebar" class="sidebar">
        <div class="">
            <div class="user-account">
                <img src="{{asset('backend/')}}/assets/images/user.png" class="rounded-circle user-photo" alt="User Profile Picture">
                <div class="dropdown">
                    <span>Welcome,</span>
                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>{{ucfirst(auth('admin')->user()->full_name)}}</strong></a>
                    <ul class="dropdown-menu dropdown-menu-right account">
                        <li><a href="page-profile2.html"><i class="icon-user"></i>My Profile</a></li>
                        <li><a href="app-inbox.html"><i class="icon-envelope-open"></i>Messages</a></li>
                        <li><a href="javascript:void(0);"><i class="icon-settings"></i>Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="page-login.html"><i class="icon-power"></i>Logout</a></li>
                    </ul>
                </div>
                <hr>
               
            </div>
           
                
            <!-- Tab panes -->
            <div class="tab-content p-l-0 p-r-0">
                <div class="tab-pane active" id="menu">
                    <nav id="left-sidebar-nav" class="sidebar-nav">
                        <ul id="main-menu" class="metismenu">
                            <li class="active">
                                <a href="{{route('admin')}}" class="has-arrow"> <span>Dashboard</span></a>
                              
                            </li>
                            <li>
                                <a href="#App" class="has-arrow"><i class="icon-picture"></i> <span>Banner Management</span></a>
                                <ul>
                                    <li><a href="{{ route('banner.index') }}">All Banner</a></li>
                                    <li><a href="{{ route('banner.create') }}">Create Banner</a></li>
                                    
                                </ul>
                            </li>

                            <li>
                                <a href="#App" class="has-arrow"><i class="icon-equalizer"></i> <span>Category Management</span></a>
                                <ul>
                                    <li><a href="{{ route('category.index') }}">All Category</a></li>
                                    <li><a href="{{ route('category.create') }}">Create Category</a></li>
                                    
                                </ul>
                            </li>

                            <li>
                                <a href="#App" class="has-arrow"><i class="icon-equalizer"></i> <span>Brand Management</span></a>
                                <ul>
                                    <li><a href="{{ route('brand.index') }}">All Brand</a></li>
                                    <li><a href="{{ route('brand.create') }}">Create Brand</a></li>
                                    
                                </ul>
                            </li>
                            
                           

                            <li>
                                <a href="#App" class="has-arrow"><i class="icon-briefcase"></i> <span>Product Management</span></a>
                                <ul>
                                    <li><a href="{{ route('product.index') }}">All Product</a></li>
                                    <li><a href="{{ route('product.create') }}">Create Product</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#App" class="has-arrow"><i class="icon-layers"></i> <span>Order Management</span></a>
                                <ul>
                                    <li><a href="{{ route('order.index') }}">All Order</a></li>
                                    
                                </ul>
                            </li>

                            <li>
                                <a href="#App" class="has-arrow"><i class="icon-basket"></i> <span>Shipping Management</span></a>
                                <ul>
                                    <li><a href="{{ route('shipping.index') }}">All Shipping</a></li>
                                    <li><a href="{{ route('shipping.create') }}">Create Shipping</a></li>
                                </ul>
                            </li>

                            {{-- <li>
                                <a href="#App" class="has-arrow"><i class="icon-grid"></i> <span>Post Category</span></a>
                                <ul>
                                    <li><a href="app-inbox.html">Inbox</a></li>
                                    <li><a href="app-chat.html">Chat</a></li>
                                </ul>
                            </li> --}}

                            {{-- <li>
                                <a href="#App" class="has-arrow"><i class="icon-tag"></i> <span>Post Tag</span></a>
                                <ul>
                                    <li><a href="app-inbox.html">Inbox</a></li>
                                    <li><a href="app-chat.html">Chat</a></li>
                                </ul>
                            </li> --}}

                            <li>
                                <a href="#App" class="has-arrow"><i class="icon-user"></i> <span>Seller Management</span></a>
                                <ul>
                                     <li><a href="{{ route('seller.index') }}">All Seller</a></li>
                                     <li><a href="#">Create Seller Account</a></li>
                                </ul>
                            </li>

                            {{-- <li>
                                <a href="#App" class="has-arrow"><i class="icon-map"></i> <span>Post Management</span></a>
                                <ul>
                                    <li><a href="app-inbox.html">Inbox</a></li>
                                    <li><a href="app-chat.html">Chat</a></li>
                                </ul>
                            </li> --}}
{{-- 
                            <li>
                                <a href="#App" class="has-arrow"><i class="icon-star"></i> <span>Review Management</span></a>
                                <ul>
                                    <li><a href="app-inbox.html">Inbox</a></li>
                                    <li><a href="app-chat.html">Chat</a></li>
                                </ul>
                            </li> --}}

                            <li>
                                <a href="#App" class="has-arrow"><i class="icon-star"></i> <span>Coupon Management</span></a>
                                <ul>
                                <li><a href="{{ route('coupon.index') }}">All Coupon</a></li>
                                    <li><a href="{{ route('coupon.create') }}">Create Coupon</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="#App" class="has-arrow"><i class="icon-star"></i> <span>User Management</span></a>
                                <ul>
                                    <li><a href="{{ route('user.index') }}">All User</a></li>
                                    <li><a href="{{ route('user.create') }}">Create User</a></li>
                                </ul>
                            </li>

                            {{-- <li>
                                <a href="#App" class="has-arrow"><i class="icon-star"></i> <span>Comments Management</span></a>
                                <ul>
                                    <li><a href="app-inbox.html">Inbox</a></li>
                                    <li><a href="app-chat.html">Chat</a></li>
                                </ul>
                            </li> --}}

                            <li>
                                <a href="#App" class="has-arrow"><i class="icon-settings"></i> <span>Setting</span></a>
                                <ul>
                                <li><a href="{{ route('seeting') }}">Setting</a></li>
                                   
                                </ul>
                            </li>
                        
                        </ul>
                    </nav>
                </div>
                <div class="tab-pane p-l-15 p-r-15" id="Chat">
                    <form>
                        <div class="input-group m-b-20">
                            <div class="input-group-prepend">
                                <span class="input-group-text" ><i class="icon-magnifier"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                    </form>
                    <ul class="right_chat list-unstyled">
                        <li class="online">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="{{asset('backend')}}/assets/images/xs/avatar4.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Chris Fox</span>
                                        <span class="message">Designer, Blogger</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>                            
                        </li>
                        <li class="online">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="{{asset('backend')}}/assets/images/xs/avatar5.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Joge Lucky</span>
                                        <span class="message">Java Developer</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>                            
                        </li>
                        <li class="offline">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="{{asset('backend')}}/assets/images/xs/avatar2.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Isabella</span>
                                        <span class="message">CEO, Thememakker</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>                            
                        </li>
                        <li class="offline">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="{{asset('backend')}}/assets/images/xs/avatar1.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Folisise Chosielie</span>
                                        <span class="message">Art director, Movie Cut</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>                            
                        </li>
                        <li class="online">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="{{asset('backend')}}/assets/images/xs/avatar3.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Alexander</span>
                                        <span class="message">Writter, Mag Editor</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>                            
                        </li>                        
                    </ul>
                </div>
                <div class="tab-pane p-l-15 p-r-15" id="setting">
                    <h6>Choose Skin</h6>
                    <ul class="choose-skin list-unstyled">
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>                   
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="cyan" class="active">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="blush">
                            <div class="blush"></div>
                            <span>Blush</span>
                        </li>
                    </ul>
                    <hr>
                    <h6>General Settings</h6>
                    <ul class="setting-list list-unstyled">
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="checkbox">
                                <span>Report Panel Usag</span>
                            </label>
                        </li>
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="checkbox" checked>
                                <span>Email Redirect</span>
                            </label>
                        </li>
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="checkbox" checked>
                                <span>Notifications</span>
                            </label>                      
                        </li>
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="checkbox">
                                <span>Auto Updates</span>
                            </label>
                        </li>
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="checkbox">
                                <span>Offline</span>
                            </label>
                        </li>
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="checkbox">
                                <span>Location Permission</span>
                            </label>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane p-l-15 p-r-15" id="question">
                    <form>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" ><i class="icon-magnifier"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                    </form>
                    <ul class="list-unstyled question">
                        <li class="menu-heading">HOW-TO</li>
                        <li><a href="javascript:void(0);">How to Create Campaign</a></li>
                        <li><a href="javascript:void(0);">Boost Your Sales</a></li>
                        <li><a href="javascript:void(0);">Website Analytics</a></li>
                        <li class="menu-heading">ACCOUNT</li>
                        <li><a href="javascript:void(0);">Cearet New Account</a></li>
                        <li><a href="javascript:void(0);">Change Password?</a></li>
                        <li><a href="javascript:void(0);">Privacy &amp; Policy</a></li>
                        <li class="menu-heading">BILLING</li>
                        <li><a href="javascript:void(0);">Payment info</a></li>
                        <li><a href="javascript:void(0);">Auto-Renewal</a></li>                        
                        <li class="menu-button m-t-30">
                            <a href="javascript:void(0);" class="btn btn-primary"><i class="icon-question"></i> Need Help?</a>
                        </li>
                    </ul>
                </div>                
            </div>          
        </div>
    </div>