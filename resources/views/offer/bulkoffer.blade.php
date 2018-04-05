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
                <h2 style="color: #989898;" class="no-margin-bottom"><b>Product List For Offer</b></h2>
            </div>
        </header>


        <div class="row">

            <div class="col-md-4 dropdown">
                <label class="form-control-label">Category</label> <br>
                <select class="form-control" id="category"name="category">
                    <option selected value="">All Category</option>

                    @foreach($categories as $category)
                        <option value="{{$category->categoryId}}">{{$category->categoryName}}</option>
                    @endforeach
                </select>

            </div>



        </div>

        <div class="table table-responsive" style="margin-top: 20px">
            <table id="allProductList" class="table table-bordered table-striped">
                <thead>
                <tr>
                    {{--<th ><input type="checkbox" id="selectall" onClick="selectAll(this)" /></th>--}}
                    <th >Select</th>
                    <th >Product Category</th>
                    <th >Product name</th>
                    <th >SKU</th>
                    <th >Last Exported Date</th>

                </tr>
                </thead>

            </table><br>


            <input type="checkbox" id="selectall2"  /><b>Select All</b><br>
        </div>
        <div class="row">
        <div class="col-md-4 dropdown">
            <label class="form-control-label">Season</label><span style="color: red" class="required">*</span> <br>
            <select class="form-control" id="season" name="season" required>
                <option selected value="">Select Season</option>

                @foreach($season as $season)
                    <option value="{{$season->seasonId}}">{{$season->seasonName}}</option>
                @endforeach
            </select>

        </div>
        <div class="col-md-4 ">
            <label class="form-control-label">Discount Percentage(%)</label><span style="color: red" class="required">*</span> <br>
            <input class="form-control" type="number" id="disprice" name="disprice">

        </div>
        </div>


        <br>

        <a onclick="insertBulkOffer()"><button class="btn btn-danger"  >Update selected Products</button></a>



    </div>
@endsection
@section('foot-js')

    {{--<script src="//code.jquery.com/jquery.js"></script>--}}
    {{--<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>--}}
    {{--    <script src="{{url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>--}}


    <script src="{{url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>


    {{--    <script src="{{url('cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js')}}"></script>--}}
    {{--<script src="{{url('cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js')}}"></script>--}}


    {{--<script src="{{url('cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js')}}"></script>--}}

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
//                "dom": 'lf<"br">irtip',
                "dom": 'lf<br>i<"toolbar">rtip',
//                bSort:false,
                "ajax":{
                    "url": "{!! route('offer.bulkOfferdt') !!}",
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
                        return '<input data-panel-id="'+data.productId+'"onclick="selected_rows(this)" type="checkbox" class="chk" name="selected_rows[]" value="'+ data.productId +'" />';},
                        "orderable": false, "searchable":false, "name":"selected_rows","className": "dt-center selectBox"},
                    { data: 'categoryName',name:'categoryName' },
                    { data: 'productName', name: 'productName' },
                    { data: 'sku', name: 'sku' },
                    { data: 'LastExportedDate', name: 'LastExportedDate' },

                ],
                order: [[0,'desc'] ],
            });
            $("div.toolbar").html('<input style="margin-left: 15px" type="checkbox" id="selectall1" /><b>Select All</b>');

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
//        function selectAll(source) {
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



        function insertBulkOffer() {

            var products=selecteds;


           // alert(products);

            if (products.length >0) {

                var disprice=document.getElementById('disprice').value;
                var season=document.getElementById('season').value;

                if (season==""){

                    $.alert({
                        title: 'Alert!',
                        type: 'red',
                        content: 'Please Select a Season for Discount',
                    });

                }
                if (disprice==""){

                    $.alert({
                        title: 'Alert!',
                        type: 'red',
                        content: 'Please Type Discount First',
                    });

                }
                if (season !="" && disprice != "") {
                    $.ajax({
                        type: 'POST',
                        url: "{!! route('offer.insertBulkOffer') !!}",
                        cache: false,
                        data: {'offers': products, 'season': season, 'disprice': disprice},
                        success: function (data) {



                            if (data.returntype == "0") {

                                $.alert({
                                    title: 'Alert!',
                                    type: 'red',
                                    content: 'discount price should be less than ' + data.productName + ' price',
                                });

                            }else {
                                location.reload();
                                selecteds=[];
                                $(':checkbox:checked').prop('checked',false);
                                $('#disprice').val("");


                            }

                            // alert(data);

                        }

                    });
                }
            }
            else {
                $.alert({
                    title: 'Alert!',
                    type: 'red',
                    content: 'Please Select a product first',
                });

            }
        }
    </script>

@endsection




