@extends('main')

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
                                <th>Colour</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Stock Quantity</th>
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

                    { data: 'productName', name: 'productName' },
                    { data: 'categoryName', name: 'categoryName' },
                    { data: 'color', name: 'color' },
                    { data: 'size', name: 'size' },
                    { data: 'price', name: 'price' },
                    { data: 'stockQty', name: 'stockQty' },
                    { "data": function(data){
                        return '<a href="#" data-panel-id="'+data.productId+'"onclick="editOffer(this)">view details</a>';},
                        "orderable": false, "searchable":false, "name":"action" }


                ],

            });

        });



    </script>
@endsection