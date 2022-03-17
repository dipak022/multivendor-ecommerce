@extends('backend.layouts.master')
@section('content')
 
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Product List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Product</li>
                            <li class="breadcrumb-item active">Product Information</li>
                        </ul>
                    </div>            
                   
                </div>
            </div>
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>{{$product->title}} </h2>    
                            <br/>
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="{{route('product.attribute',$product->id)}}" method="post">
                                        @csrf
                                            <div id="example-1" class="content" data-mfield-options='{"section": ".group","btnAdd":"#btnAdd-1","btnRemove":".btnRemove"}'>
                                            <div class="row">
                                                <div class="col-md-12"><button type="button" id="btnAdd-1" class="btn btn-primary">Add </button></div>
                                            </div>
                                            <div class="row group">
                                                <div class="col-md-2">
                                                    <level> Size</level>
                                                    <input class="form-control form-control-sm" placeholder="size" name="size[]" type="text">
                                                </div>
                                                <div class="col-md-3">
                                                <level> Original price</level>
                                                    <input class="form-control form-control-sm" placeholder="Original price" name="original_price[]" type="text">
                                                </div>
                                                <div class="col-md-3">
                                                <level> Offer price</level>
                                                    <input class="form-control form-control-sm" placeholder="Offer price" name="offer_price[]" type="text">
                                                </div>
                                                <div class="col-md-2">
                                                <level> Stock</level>
                                                    <input class="form-control form-control-sm" placeholder="Stock" name="stock[]" type="number">
                                                </div>
                                                
                                                <div class="col-md-2">
                                                <level> Delete</level>
                                                </br>
                                                    <button type="button" class="btn btn-sm btn-danger btnRemove"><i class="float-left fa fa-trash-o"></i></button>
                                                </div>
                                            </div>
                                            
                                           
                                        </div>
                                        <br/>
                                        <button class="btn btn-success" type="submit">Submit</button>

                                    </form>
                              

                                </div>
                                <div class="col-md-6">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Size</th>
                                            <th>Orginal</th>
                                            <th>Offer</th>
                                            <th>Stock</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($productattr)>0)
                                            @foreach($productattr as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->size}}</td>
                                                <td>{{$item->original_price}}</td>
                                                <td>{{$item->offer_price}}</td>
                                                <td>{{$item->stock}}</td>
                                                <td>
                                                    <form class="float-left px-2" action="{{ route('product.attribute.destroy',$item->id) }}" method="POST">
                                                        @csrf 
                                                        @method('delete')
                                                        <a type="button" data-type="confirm" class="dltBtn btn btn-danger js-sweetalert " title="Delete"><i class="float-left fa fa-trash-o"></i></a>
                                                    </form>
                                                 </td>
                                            </tr>

                                            @endforeach
                                        @endif    
                                    </tbody>
                                </table>
                                </div>
                            </div>                        
                        </div>
                        <div class="body">
						<div class="table-responsive">
                          
							</div>
                        </div>
                    </div>
                </div>
            </div>

           

        </div>
</div>

@endsection

@section('scripts')
<script src="{{asset('backend/asset/js/jquery.multifield.min.js')}}"></script>
<script>
$('#example-1').multifield();
</script>
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




@endsection