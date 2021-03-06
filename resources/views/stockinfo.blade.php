@extends('main')
@section('header')
    {{--<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">--}}
    <style>
        /*th.dt-center, td.dt-center { text-align: center; }*/
        table{font-size: 15px}
        .container-fluid {padding: 15px  5px;}
    </style>
@endsection
@section('content')

    <!-- Page Header-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="margin-left: 10px; border-radius: 10px;">

                <div class="card-body" style="padding: 1%;">
                    <div align="center" style="margin-bottom: 3%;">
                        <h2 style="color: #989898;"><b>Stock Info</b></h2>
                    </div>

                    <div class="table table-responsive">
                        <table id="stockinfo" class="table table-hover"  >
                            <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>SKU</th>
                                <th>Location</th>
                                <th>RRP</th>
                                <th>Stock Quantity</th>
                                <th>Min Qty Alert</th>
                                <th>Image</th>
                                <th>Colour</th>
                                {{--<th>Date</th>--}}
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>


                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('foot-js')
    <script src="{{url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    {{--<script src="https://cdn.datatables.net/select/1.2.5/js/dataTables.select.min.js"></script>--}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script>

        $(document).ready(function() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            table =  $('#stockinfo').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax":{
                    "url": "{!! route('stockinfo.showinfo') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                    },
                },
                columns: [

                    { data: 'productName', name: 'productName' ,"orderable": false },
                    { data: 'categoryName', name: 'categoryName' },
                    { data: 'sku', name: 'sku' },
                    { data: 'location', name: 'location' },
                    { data: 'price', name: 'price' },
                    { data: 'stockQty', name: 'stockQty' },
                    { data: 'minQtyAlert', name: 'minQtyAlert' },
                    { "data": function(data){
                        return'<img width="80" height="60" src="{{url('public/productImage/thumb')."/"}}'+data.mainImage+'">';
                },
                        "orderable": false, "searchable":false, "name":"image" },
                    { data: 'color', name: 'color' },
//                    { data: 'created_at', name: 'created_at' },
                    { "data": function(data){
                        return '<a style="cursor: pointer; color: #4881ecfa" data-panel-id="'+data.productId+'"onclick="editProduct(this)">view details</a>';},
                        "orderable": false, "searchable":false, "name":"action" }


                ],

            });

        });

        function editProduct(x) {
            btn = $(x).data('panel-id');
            var url = '{{route("product.edit", ":id") }}';
            //alert(url);
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;
        }

    </script>
@endsection