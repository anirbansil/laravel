@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">{{ __('Product List') }}</div>
                        <div class="col-md-6" style="text-align: right;">
                            <a href="{{ route('new-product') }}" class="btn btn-primary">Add New</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th width="15%">Image</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productlist as $product)
                            <tr class="trclass-{{ $product->product_id }}">
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->product_price }}</td>
                                <td width="15%"><img src="{{url('/'.$product->product_image) }}" width="100%"></td>
                                <td>{{ $product->product_stock }}</td>
                                <td>
                                    <a href="{{ route('edit', ['id' => $product->product_id]) }}" class="editdata"><i class="fa fa-pencil-square" aria-hidden="true"></i></a> | <a href="javascript:void(0)" class="deletedata" data-id="{{ $product->product_id }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#example').DataTable({
        "order": []
    });

    $(document).ready(function(){
        $(".deletedata").on('click', function(){
            var clickedElement = $(this);
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
                    var dataid = clickedElement.data('id');
                    
                    $.ajax({
                        url: '/delete/' + dataid,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Your data has been deleted.',
                                'success'
                            );

                            $('.trclass-'+dataid).hide();
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                'An error occurred while deleting the data.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });

    
</script>
@endsection
