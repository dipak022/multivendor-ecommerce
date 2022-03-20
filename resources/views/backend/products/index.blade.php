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
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                            <!--
                            <h3 > Total Product :{{\App\Models\Product::count()}} </h3>
                            -->
                            <h3 > Total Product :{{$product->count()}} </h3>
                            
                        </div>
                        <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                        <a class="btn btn-success" href="{{route('product.create')}}">Add Product</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Product Information List </h2>                            
                        </div>
                        <div class="body">
						<div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Title</th>
                                        <th>Photo</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Size</th>
                                        <th>Condition</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                               
                                <tbody>
                                    @foreach($product as $item)
                                       @php
                                         $photo=explode(',',$item->photo);
                                       @endphp
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->title}}</td>
                                        <td>
                                        <img src="{{$photo[0]}}" id="holder" style="margin-top:15px;max-height:100px;"></img>
                                        </td>
                                        <td>{{ number_format($item->price,2) }}</td>
                                        <td>{{ $item->discount }}%</td>
                                        <td>{{ $item->size }}</td>
                                        <td>
                                            @if($item->conditions === 'new')
                                            <span class="badge badge-success">{{$item->conditions}}</span>
                                            @elseif($item->conditions === 'popular')
                                            <span class="badge badge-info">{{$item->conditions}}</span>
                                            @else
                                            <span class="badge badge-primary">{{$item->conditions}}</span>
                                            @endif
                                        </td>
                                        <td>
                                        <input type="checkbox" name="toogle" value="{{$item->id}}" data-toggle="switchbutton" {{$item->status == 'active' ? 'checked' : ''}}  data-onlabel="Active" data-offlabel="Inactive" data-onstyle="success" data-size="sm" data-offstyle="danger">

                                        </td>
                                        <td>
                                            <a href="{{route('product.show',$item->id)}}"  class="btn btn-info" href="#defaultModal" ><i class="float-left fa fa-plus"></i></a>
                                            <a type="button"  class="btn btn-secondary" href="#defaultModal" data-toggle="modal" data-target="#ProductID{{$item->id}}"><i class="float-left fa fa-eye"></i></a>
                                            <a type="button" href="{{route('product.edit',$item->id)}}" class="btn btn-info" title="Edit"><i class="float-left fa fa-edit"></i></a>
                                            <form class="float-left px-2" action="{{ route('product.destroy',$item->id) }}" method="POST">
                                                @csrf 
                                                @method('delete')
                                                <a type="button" data-type="confirm" class="dltBtn btn btn-danger js-sweetalert " title="Delete"><i class="float-left fa fa-trash-o"></i></a>

                                            </form>
                                            
                                        </td>

                                        <!-- start Modal -->

                                        <div class="modal fade" id="ProductID{{$item->id}}" tabindex="-1" role="dialog">
                                            @php
                                                $product = \App\Models\Product::where('id',$item->id)->first();
                                            @endphp
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="text-center" id="defaultModalLabel">{{  \Illuminate\Support\Str::upper($product->title)  }}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <strong>Sammary :</strong>
                                                                <p>{!! html_entity_decode($product->sammary) !!}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>Description :</strong>
                                                                <p>{!! html_entity_decode($product->description) !!}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <strong>Category :</strong>
                                                                <p>{{ \App\Models\Category::where('id',$product->cat_id)->value('title') }}</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <strong>Child Category :</strong>
                                                                <p>{{ \App\Models\Category::where('id',$product->clild_cat_id)->value('title') }}</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <strong>Brand :</strong>
                                                                <p>{{ \App\Models\Category::where('id',$product->brand_id)->value('title') }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <strong>Size :</strong>
                                                                <p class="badge badge-success">{{  $product->size }} </p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <strong>Status :</strong>
                                                                <p class="badge badge-success">{{  $product->status }} </p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <strong>Conditions :</strong>
                                                                <p class="badge badge-success">{{  $product->conditions }} </p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <strong>Price :</strong>
                                                                <p>{{ number_format($product->price,2) }} TK</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <strong>Offer Price :</strong>
                                                                <p>{{ number_format($product->offer_price,2) }} TK</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <strong>Discount Price :</strong>
                                                                <p>{{ number_format($product->discount,2) }} TK</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <strong>Vendor Name :</strong>
                                                                <p>{{ \App\Models\User::where('id',$product->brand_id)->value('full_name') }}</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <strong>Stock :</strong>
                                                                <p>{{ number_format($product->strock,2) }} Available</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                               
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
       url:"{{ route('product.status')}}",
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