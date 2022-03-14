@extends('backend.layouts.master')
@section('content')
 
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Coupon List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Coupon</li>
                            <li class="breadcrumb-item active">Coupon Information</li>
                        </ul>
                    </div>            
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                            <h3 > Total Coupon :{{\App\Models\Coupon::count()}} </h3>
                        </div>
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                        <a class="btn btn-success" href="{{route('coupon.create')}}">Add Coupon</a>
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
                                        <th>Code</th>
                                        <th>Type</th>
                                        <th>Value</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                               
                                <tbody>
                                    @foreach($coupon as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->code}}</td>
                                        <td>
                                            @if($item->type === 'fixed')
                                            <span class="badge badge-success">Fixed</span>
                                            @else
                                            <span class="badge badge-primary">Percentage</span>
                                            @endif
                                        </td>
                                        <td>{{$item->value}}</td>
                                        <td>
                                        <input type="checkbox" name="toogle" value="{{$item->id}}" data-toggle="switchbutton" {{$item->status == 'active' ? 'checked' : ''}}  data-onlabel="Active" data-offlabel="Inactive" data-onstyle="success" data-size="sm" data-offstyle="danger">
                                        </td>
                                        <td>
                                            <a type="button" href="{{route('coupon.edit',$item->id)}}" class="btn btn-info" title="Edit"><i class="float-left fa fa-edit"></i></a>
                                            <form class="float-left px-2" action="{{ route('coupon.destroy',$item->id) }}" method="POST">
                                                @csrf 
                                                @method('delete')
                                                <a type="button" data-type="confirm" class="dltBtn btn btn-danger js-sweetalert " title="Delete"><i class="float-left fa fa-trash-o"></i></a>

                                            </form>
                                            
                                        </td>
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
       url:"{{ route('coupon.status')}}",
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