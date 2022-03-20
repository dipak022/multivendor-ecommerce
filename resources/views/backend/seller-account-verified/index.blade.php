@extends('backend.layouts.master')
@section('content')
 
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Seller List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Seller</li>
                            <li class="breadcrumb-item active">Seller Information</li>
                        </ul>
                    </div>            
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                            <h3 > Total Seller :{{\App\Models\Seller::count()}} </h3>
                        </div>
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                        <a class="btn btn-success" href="{{route('seller.create')}}">Add Seller</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Banners Information List </h2>                            
                        </div>
                        <div class="body">
						<div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Full Name</th>
                                        <th>Username</th>
                                        <th>Photo</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Is verified</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                               
                                <tbody>
                                    @foreach($seller as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->full_name}}</td>
                                        <td>{{$item->username}}</td>
                                        <td>
                                        <img src="{{$item->photo}}" id="holder" style="margin-top:15px;max-height:100px; border-radius:50%;" ></img>
                                        </td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>
                                        <input type="checkbox" name="is_verified" value="{{$item->id}}" data-toggle="switchbutton" {{$item->is_verified == '1' ? 'checked' : ''}}  data-onlabel="on" data-offlabel="off" data-onstyle="success" data-size="sm" data-offstyle="danger">
                                        </td>
                                       
                                        <td>
                                        <input type="checkbox" name="toogle" value="{{$item->id}}" data-toggle="switchbutton" {{$item->status == 'active' ? 'checked' : ''}}  data-onlabel="Active" data-offlabel="Inactive" data-onstyle="success" data-size="sm" data-offstyle="danger">
                                        </td>
                                        <td>
                                            <a type="button"  class="btn btn-secondary" href="#defaultModal" data-toggle="modal" data-target="#UserID{{$item->id}}"><i class="float-left fa fa-eye"></i></a>
                                            <a type="button" href="{{route('user.edit',$item->id)}}" class="btn btn-info" title="Edit"><i class="float-left fa fa-edit"></i></a>
                                            <form class="float-left px-2" action="{{ route('user.destroy',$item->id) }}" method="POST">
                                                @csrf 
                                                @method('delete')
                                                <a type="button" data-type="confirm" class="dltBtn btn btn-danger js-sweetalert " title="Delete"><i class="float-left fa fa-trash-o"></i></a>

                                            </form>
                                            
                                        </td>
                                         <!-- start Modal -->

                                         <div class="modal fade" id="UserID{{$item->id}}" tabindex="-1" role="dialog">
                                            @php
                                                $user = \App\Models\User::where('id',$item->id)->first();
                                            @endphp
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="text-center" id="defaultModalLabel">{{  \Illuminate\Support\Str::upper($user->full_name) }}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <strong>Username :</strong>
                                                                <p>{{  \Illuminate\Support\Str::upper($user->username)  }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>Email :</strong>
                                                                <p>{{ $user->email }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <strong>Phone :</strong>
                                                                <p>{{  $user->phone  }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>Address :</strong>
                                                                <p>{{ $user->address }}</p>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <strong>Role :</strong>
                                                                <p class="badge badge-success">{{  $user->role }} </p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>Status :</strong>
                                                                <p class="badge badge-primary">{{  $user->status }} </p>
                                                            </div>
                                                        </div>
                                                       
      
                                                    </div>
                                                    <div class="modal-footer">
                                                        <!--
                                                        <button type="button" class="btn btn-primary">SAVE CHANGES</button>
                                                        -->
                                                        <button type="button" class="btn btn-success" data-dismiss="modal">CLOSE</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end Modal -->
                                    </tr>
                                    @endforeach
                                  
                                   
                                </tbody>
                            </table>
							</div>
                        </div>
                    </div>
                </div>
            </div>

           

        </div>
    </div>
@endsection

@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $('.dltBtn').click(function(e){
       
        var form = $(this).closest('form');
        var dataId = $(this).data('id');
        e.preventDefault();
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
            Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
        }
        })
        
        

    });

</script>

<script>
$('input[name=toogle]').change(function(){
   var mode = $(this).prop('checked');
   var id = $(this).val();
   //alert(id);
   $.ajax({
       url:"{{ route('seller.status')}}",
       type:"POST",
       data:{
           _token:'{{csrf_token()}}',
           mode:mode,
           id:id,
       },
       success:function(response){
           console.log(response.status);

       }
   })
});
</script>


<script>
$('input[name=is_verified]').change(function(){
   var mode = $(this).prop('checked');
   var id = $(this).val();
   //alert(id);
   $.ajax({
       url:"{{ route('is_verified.seller.status')}}",
       type:"POST",
       data:{
           _token:'{{csrf_token()}}',
           mode:mode,
           id:id,
       },
       success:function(response){
           console.log(response.status);

       }
   })
});
</script>


@endsection