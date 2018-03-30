@extends('main')
@section('header')
    {{--<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">--}}
@endsection

@section('content')

    <div  style="padding: 10px; background-color:white";>

        <!-- Page Header-->
        <header class="page-header">
        <div align="center" class="container-fluid">
            <h2 style="color: #989898;" class="no-margin-bottom"><b>Product List</b></h2>
        </div>
        </header>


        <div class="row">

            <div class="col-md-4 dropdown">
                <label class="form-control-label">Category</label> <br>
                <select class="form-control" id="category" name="category">
                    <option selected value="">All Category</option>

                    @foreach($categories as $category)
                        <option value="{{$category->categoryId}}">{{$category->categoryName}}</option>
                    @endforeach
                </select>

            </div>

            {{--<div class="col-md-4 dropdown">--}}
                {{--<label class="form-control-label">Product Name</label> <br>--}}
                {{--<select class="form-control" id="product" name="product">--}}
                    {{--<option selected value="">All Product</option>--}}
                    {{--@foreach($productsList as $products)--}}
                        {{--<option value="{{$products->productName}}">{{$products->productName}}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}

            <div class="col-md-4 dropdown">
                <label class="form-control-label">Status</label> <br>
                <select class="form-control" id="status" name="status">
                    <option selected value="">Select Status</option>
                    <?php for ($i=0;$i<count(Status);$i++){?>

                    <option value="<?php echo Status[$i]?>"><?php echo Status[$i]?></option>

                    <?php } ?>

                </select>

            </div>

        </div>

        <div class="table table-responsive" style="margin-top: 20px">
            <table id="allProductList" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th >Select</th>
                    <th width="20%" >Product Category</th>
                    <th >Style</th>
                    <th >SKU</th>
                    <th width="20%">Product name</th>
                    <th >Brand name</th>
                    <th >status</th>
                    {{--<th >Last Exported By</th>--}}
                    <th >Last Exported Date</th>
                    <th width="10%">Action</th>
                </tr>
                </thead>

            </table><br>

            <input style="margin-left: 15px" type="checkbox" id="selectall" onClick="selectAll(this)" /><b>Select All</b><br>
        </div>


        <a  onclick="return myfunc()" download> <button class="btn btn-danger"  >Export into Products files</button></a>
        <a  onclick="return excel()"> <button class="btn btn-danger"  >Download Products into Local Computer</button></a>


    </div>
@endsection
@section('foot-js')

    <script src="{{url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script>
        var table;
        $(document).ready(function() {
            $(':checkbox:checked').prop('checked',false);
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            table = $('#allProductList').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax":{
                    "url": "{!! route('product.data') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                        d.status=$('#status').val();
                        d.categoryId=$('#category').val();
                        d.productName=$('#product').val();
                    },
                },
                columns: [
                    { "data": function(data){

                        return '<input data-panel-id="'+data.productId+'"onclick="selected_rows(this)"  type="checkbox" class="chk" name="selected_rows[]" value="'+ data.productId +'" />';},
                        "orderable": false, "searchable":false, "name":"selected_rows"},
                    { data: 'categoryName',name:'categoryName' },
                    { data: 'style', name: 'style' },
                    { data: 'sku', name: 'sku' },
                    { data: 'productName', name: 'productName' },
                    { data: 'brand', name: 'brand' },
                    { data: 'status', name: 'status' },
//                    { data: 'userName', name: 'userName' },
                    { data: 'LastExportedDate', name: 'LastExportedDate' },
                    { "data": function(data){
                        var url='{{url("product/edit/", ":id") }}';
                        return '<a class="btn btn-default btn-sm" data-panel-id="'+data.productId+'"onclick="editProduct(this)"><i class="fa fa-edit"></i></a><a class="btn" data-panel-id="'+data.productId+'"onclick="deleteProduct(this)"><i class="fa fa-trash"></i></a>';},
                        "orderable": false, "searchable":false, "name":"selected_rows" },
                ],
                order: [[0,'desc'] ],
            });
            $('#status').change(function(){ //button filter event click
                table.search("").draw(); //just redraw myTableFilter
                table.ajax.reload();  //just reload table
            });
            $('#category').change(function(){ //button filter event click
                table.search("").draw(); //just redraw myTableFilter
                table.ajax.reload();  //just reload table
            });
            $('#product').change(function(){ //button filter event click
                table.search("").draw(); //just redraw myTableFilter
                table.ajax.reload();  //just reload table
            });
        });
        function selectAll(source) {
            checkboxes = document.getElementsByName('selected_rows[]');
            for(var i in checkboxes)
                checkboxes[i].checked = source.checked;
        }
        function editProduct(x) {
            btn = $(x).data('panel-id');
            var url = '{{route("product.edit", ":id") }}';
            //alert(url);
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;
        }
        function deleteProduct(x) {
            btn = $(x).data('panel-id');
            var url = '{{route("product.destroy", ":id") }}';
            //alert(url);
            var result = confirm("Want to delete?");
            if (result) {
                var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;}
        }

        var selecteds = [];
        function selected_rows(x) {
            btn = $(x).data('panel-id');
            var index = selecteds.indexOf(btn)
            if (index == "-1"){
                selecteds.push(btn);
            }else {

                selecteds.splice(index, 1);
            }
        }
        function selectAll(source) {


            for(var i=0; i <= selecteds.length; i++) {
                selecteds.pop(i);
            }
            //alert(selecteds);

//            $(':checkbox:checked').prop('checked',false);
            checkboxes = document.getElementsByName('selected_rows[]');
            for(var i in checkboxes) {
                checkboxes[i].checked = source.checked;
            }

            /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
            $(".chk:checked").each(function () {
                selecteds.push($(this).val());
            });
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function myfunc() {


//            var i;
//            /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
//            $(".chk:checked").each(function () {
//                selecteds.push($(this).val());
//            });


            var products=selecteds;

            //alert(products);

            if (products.length >0) {

                $.ajax({
                    type: 'POST',
                    url: "{!! route('product.csv') !!}",
                    cache: false,
                    data: {'products': products},
                    success: function (data) {

                        $('#SessionMessage').load(document.URL +  ' #SessionMessage');
                        table.ajax.reload();  //just reload table

                        for(var i=0; i <= selecteds.length; i++) {
                            selecteds.pop(i);
                        }

                        {{--var link = document.createElement("a");--}}
                        {{--link.download = data.fileName+".csv";--}}
                        {{--var uri = '{{url("public/csv")}}'+"/"+data.fileName+".csv";--}}
                        {{--link.href = uri;--}}
                        {{--document.body.appendChild(link);--}}
                        {{--link.click();--}}
                        {{--document.body.removeChild(link);--}}
                        {{--delete link;--}}


                    }

                });
            }
            else {
                alert("Please Select a product first");
            }
        }

        function excel() {


            var products=selecteds;

            //alert(products);

            if (products.length >0) {

                $.ajax({
                    type: 'POST',
                    url: "{!!route('product.excelExport') !!}",
                    cache: false,
                    data: {'products': products},
                    success: function (data) {
                        var link = document.createElement("a");
                        link.download = data.fileName+".xls";
                        var uri = '{{url("public/excel")}}'+"/"+data.fileName+".xls";
                        link.href = uri;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                        delete link;

                    }

                });
            }
            else {
                alert("Please Select a product first");
            }
        }

    </script>

@endsection




