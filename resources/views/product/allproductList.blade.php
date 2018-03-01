@extends('main')
@section('header')
    {{--<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">--}}
@endsection

@section('content')

    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Product List</h2>
        </div>
    </header>


    <div  style="padding: 10px; background-color:white";>

        <div class="row">
        <div class="col-md-4 dropdown">
            <label class="form-control-label">Status</label> <br>
            <select class="form-control" id="status" name="status">
                <option selected value="">--Select Status--</option>
                <?php for ($i=0;$i<count(Status);$i++){?>

                <option value="<?php echo Status[$i]?>"><?php echo Status[$i]?></option>

              <?php } ?>

            </select>

        </div>
        <div class="col-md-4 dropdown">
            <label class="form-control-label">Category</label> <br>
            <select class="form-control" id="status" name="status" onchange="status(this.value)">
                <option value="">--Select Status--</option>

                @foreach($categories as $category)
                    <option value="{{$category->categoryId}}">{{$category->name}}</option>
                @endforeach
            </select>

        </div>

        <div class="col-md-4 dropdown">
            <label class="form-control-label">Product Name</label> <br>
            <select class="form-control" id="status" name="status" onchange="status(this.value)">
                <option value="">--Select Status--</option>
                @foreach($productsList as $products)
                    <option value="{{$products->productId}}">{{$products->productName}}</option>
                @endforeach
            </select>
        </div>

            {{--<div class="col-md-3 form-group">--}}
                {{--<label class="form-control-label" >Search</label>--}}
                {{--<input name="line2" type="text" class="form-control required validate" onkeyup="search(this.value)">--}}
            {{--</div>--}}

        </div>

        <div class="table table-responsive" style="margin-top: 20px">
        <table id="allProductList" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Select</th>
                <th >Product Category</th>
                <th>Style</th>
                <th>SKU</th>
                <th>Product name</th>
                <th>Brand name</th>
                <th>status</th>
                <th>Last Exported By</th>
                <th>Last Exported Date</th>
                <th>Action</th>
            </tr>
            </thead>

        </table>

        </div>

        <a href="csv/product.csv" onclick="return myfunc()" download> <button class="btn btn-danger"  >Export Products file</button></a>

    </div>
@endsection
@section('foot-js')

    {{--<script src="//code.jquery.com/jquery.js"></script>--}}
    {{--<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>--}}
{{--    <script src="{{url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>--}}


    <script src="{{url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>


    {{--<script src="{{url('cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js')}}"></script>--}}
    {{--<script src="{{url('cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js')}}"></script>--}}


    {{--<script src="{{url('cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js')}}"></script>--}}

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script>
        var table;
        $(document).ready(function() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            table = $('#allProductList').DataTable({

                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax":{
                    "url": "{!! route('product.data') !!}",
                    "type": "POST",

                    "data":{
                        _token: "{{csrf_token()}}",
                        status : $('#status').val(),

                    },
                },
                columns: [
                    { data: 'productId', name: 'productId' },
                    { data: 'categoryName', name: 'categoryName' },
                    { data: 'style', name: 'style' },
                    { data: 'sku', name: 'sku' },
                    { data: 'productName', name: 'productName' },
                    { data: 'brand', name: 'brand' },
                    { data: 'status', name: 'status' },
                    { data: 'LastExportedBy', name: 'LastExportedBy' },
                    { data: 'LastExportedDate', name: 'LastExportedDate' },
                    { data: 'LastExportedDate', name: 'LastExportedDate' },

                ],

            });
            $('#status').change(function(){ //button filter event click
                table.search("").draw(); //just redraw myTableFilter
                table.ajax.reload();  //just reload table

//                var status = $('#status').val();
//                alert(status);


            });

        });

    </script>

@endsection





