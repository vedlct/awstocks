@extends('main')
@section('header')
    {{--<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">--}}
    <style>
        th.dt-center, td.dt-center { text-align: center; }
        table{font-size: 15px}
        .container-fluid {padding: 15px  15px;}
    </style>
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
                    {{--<th width="1%"><input type="checkbox" id="selectall" onClick="selectAll(this)" /></th>--}}
                    <th width="15%" >Product Category</th>
                    <th width="10%">Style</th>
                    <th width="5%">SKU</th>
                    <th width="20%">Product name</th>
                    <th width="15%">Brand name</th>
                    <th width="5%">status</th>
                    {{--<th >Last Exported By</th>--}}
                    <th width="10%">Last Exported Date</th>
                    <th width="10%">Action</th>
                </tr>
                </thead>

            </table><br>

            <input style="margin-left: 15px" type="checkbox" class="SelectAll" id="selectall2"  /><b>Select All</b><br>
        </div>
        <div class="row">
            <div style="text-align: left" class="col-md-4 col-sm-4">
        <a  onclick="return myfunc()" download> <button class="btn btn-danger"  >Export Product and Offer File</button></a>
            </div>
            <div style="text-align: right" class="col-md-8 col-sm-8">
        <a  href="{{url("public/csv/ProductList.csv")}}" download > <button class="btn btn-danger">Download Exported Product File</button></a>
        <a  href="{{url("public/csv/OfferList.csv")}}" download > <button class="btn btn-danger">Download Exported Offer File</button></a>
        <a  onclick="return excel()"> <button class="btn btn-danger"  >Download Products into Local Computer</button></a>
            </div>
        </div>
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
                "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
                "dom": 'lf"<br>"i<"toolbar">rtip',
//                "dom": 'lf<"br">irtip',

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

                        return '<input  data-panel-id="'+data.productId+'"onclick="selected_rows(this)" type="checkbox" class="chk" name="selected_rows[]" value="'+ data.productId +'" />';},
                        "orderable": false, "searchable":false, "name":"selected_rows", "className": "dt-center selectBox"},
                    { data: 'categoryName',name:'categoryName',"orderable": false },
                    { data: 'style', name: 'style' },
                    { data: 'sku', name: 'sku' },
                    { data: 'productName', name: 'productName' },
                    { data: 'brand', name: 'brand' },
                    { data: 'status', name: 'status',"orderable": false },
//                    { data: 'userName', name: 'userName' },
                    { data: 'LastExportedDate', name: 'LastExportedDate' },
                    { "data": function(data){
                        var url='{{url("product/edit/", ":id") }}';
                        return '<a class="btn btn-default btn-sm" data-panel-id="'+data.productId+'"onclick="editProduct(this)"><i class="fa fa-edit"></i></a><a class="btn" data-panel-id="'+data.productId+'"onclick="deleteProduct(this)"><i class="fa fa-trash"></i></a>';},
                        "orderable": false, "searchable":false, "name":"selected_rows" },
                ],
                order: [[0,'desc'] ],

            });
            $("div.toolbar").html('<input style="margin-left: 15px" type="checkbox" class="SelectAll" id="selectall1" /><b>Select All</b>');
            $('#allProductList').on( 'length.dt', function ( e, settings, len ) {
                selecteds=[];
                $(':checkbox:checked').prop('checked',false);
            });
            $('#allProductList').on( 'page.dt', function ( e, settings, len ) {
                selecteds=[];
                $(':checkbox:checked').prop('checked',false);
            });
            $('#allProductList').on( 'search.dt', function ( e, settings, len ) {
                selecteds=[];
                $(':checkbox:checked').prop('checked',false);
            });

            $('#status').change(function(){ //button filter event click
                table.search("").draw(); //just redraw myTableFilter
                table.ajax.reload();  //just reload table
                selecteds=[];
                $(':checkbox:checked').prop('checked',false);

            });
            $('#category').change(function(){ //button filter event click
                table.search("").draw(); //just redraw myTableFilter
                table.ajax.reload();  //just reload table
                selecteds=[];
                $(':checkbox:checked').prop('checked',false);
            });
            $('#product').change(function(){ //button filter event click
                table.search("").draw(); //just redraw myTableFilter
                table.ajax.reload();  //just reload table
                selecteds=[];
               // $('.SelectAll').attr('checked', false);
                $(':checkbox:checked').prop('checked',false);
            });

            // add multiple select / deselect functionality
            $("#selectall2").click(function () {

                if($('#selectall2').is(":checked")) {
                    selecteds=[];
                    $('#selectall1').prop('checked',true);
                checkboxes = document.getElementsByName('selected_rows[]');
                for(var i in checkboxes) {
                    checkboxes[i].checked = 'TRUE';
                }

                    /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
                    $(".chk:checked").each(function () {
                        selecteds.push($(this).val());
                    });
                  //  alert(selecteds);


                }
                else {
                    selecteds=[];
                    $(':checkbox:checked').prop('checked',false);
                }

            });

            // add multiple select / deselect functionality
            $("#selectall1").click(function () {

                if($('#selectall1').is(":checked")) {
                    selecteds=[];
                    $('#selectall2').prop('checked',true);
                    checkboxes = document.getElementsByName('selected_rows[]');
                    for(var i in checkboxes) {
                        checkboxes[i].checked = 'TRUE';
                    }

                    /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
                    $(".chk:checked").each(function () {
                        selecteds.push($(this).val());
                    });
                   // alert(selecteds);


                }
                else {
                    selecteds=[];
                    $(':checkbox:checked').prop('checked',false);
                }

            });


        });
//        function selectAll(source) {
//            checkboxes = document.getElementsByName('selected_rows[]');
//            for(var i in checkboxes)
//                checkboxes[i].checked = source.checked;
//        }
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

            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure you would like to delete the selected product?',
                icon: 'fa fa-warning',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'Yes',
                        btnClass: 'btn-red',
                        action: function(){
                            var newUrl=url.replace(':id', btn);
                            window.location.href = newUrl;
                        }
                    },
                    No: function () {

                    },
                }
            });

        }


        var selecteds = [];
        function selected_rows(x) {

            btn = $(x).data('panel-id');
            var index = selecteds.indexOf(btn.toString())
            if (index == "-1"){
                selecteds.push(btn);
            }else {

                selecteds.splice(index, 1);
            }

        }
//        function selectAll(source) {
//
////            $("#selectall").checked(true);
//
//            for(var i=0; i <= selecteds.length; i++) {
//                selecteds.pop(i);
//            }
//            //alert(selecteds);
//
////            $(':checkbox:checked').prop('checked',false);
//            checkboxes = document.getElementsByName('selected_rows[]');
//            for(var i in checkboxes) {
//                checkboxes[i].checked = source.checked;
//            }
//
//            /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
//            $(".chk:checked").each(function () {
//                selecteds.push($(this).val());
//            });
//        }
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

                        selecteds=[];

                        $(':checkbox:checked').prop('checked',false);
                        //alert(data);



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

                        selecteds=[];
                        $(':checkbox:checked').prop('checked',false);

                    }

                });
            }
            else {
                alert("Please Select a product first");
            }
        }

    </script>

@endsection




