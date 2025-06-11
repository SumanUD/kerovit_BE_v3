@extends('adminlte::page')

@section('title', 'All Products')

@section('content_header')
    <h1>All Products</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table id="products-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Code</th>
                        <th>Thumbnail</th>
                        <th>Collection</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('css')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
@stop

@section('js')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script>
        $(function () {
            $('#products-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("products.data") }}',
                columns: [
                    { data: 'product_id', name: 'product_id' },
                    { data: 'product_code', name: 'product_code' },
                    {
                        data: 'thumbnail_picture',
                        name: 'thumbnail_picture',
                        render: function (data, type, row) {
                            return data 
                                ? `<img src="/storage/AllImages/${data}.png" width="60" height="60" style="object-fit: cover; border-radius: 6px;" />`
                                : '-';
                        }
                    },
                    {
                        data: 'collection',
                        name: 'collection.name',
                        defaultContent: '-'
                    },
                    {
                        data: 'category_name',
                        name: 'category.name',
                        defaultContent: '-'
                    },
                    {
                        data: 'product_id',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return `<a href="/admin/products/${data}/edit" class="btn btn-sm btn-primary">Edit</a>
                            <a href="/admin/products/${data}/view" class="btn btn-sm btn-warning">View</a>`;
                        }
                    },
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'csvHtml5',
                        title: 'Products Export',
                        className: 'btn btn-sm btn-primary'
                    }
                ],
                responsive: true
            });
        });
    </script>
@stop
