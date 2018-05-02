@extends('main')
@section('header')
    {{--<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">--}}
    <style>
        th.dt-center, td.dt-center { text-align: center; }
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
                    <h2 style="color: #989898;"><b>Offer List</b></h2>
                </div>

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
                        <label class="form-control-label">Offer Status</label> <br>
                        <select class="form-control" id="product" name="product">
                            <option selected value="">All Offer Status</option>
                            <?php for ($i=0;$i<count(Status);$i++){?>

                            <option value="<?php echo Status[$i]?>"><?php echo Status[$i]?></option>

                            <?php } ?>
                        </select>
                    </div>
                </div>
                <br>
        <div class="table table-responsive">
         <table id="offerlist" class="table table-bordered table-striped"  >
            <thead>
            <tr>

                {{--<th><input type="checkbox" id="selectall" onClick="selectAll(this)" /></th>--}}
                <th>Select</th>
                <th>Category</th>
                <th>Sku</th>
                <th>Price</th>
                <th>State</th>
                <th>Quantity</th>
                <th>Discount Price</th>
                <th>Discount Start Date</th>
                <th>Discount End Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
            <br>
            <input type="checkbox" id="selectall2" /><b>Select All</b>

        </div>
                <div class="row">
                    {{--<div style="text-align: left" class="col-md-8">--}}
                    <div class="col-md-2">
                        <a  onclick="return creationFull()" download> <button class="btn btn-danger" >Export Full into Offer files</button></a>
                    </div>
                    <div class="col-md-2">
                        <a  onclick="return priceUpdate()" download> <button class="btn btn-danger">Export Price Update</button></a>
                    </div>
                     <div class="col-md-2">
                        <a  onclick="return stockUpdate()" download> <button class="btn btn-danger">Export Stock Update</button></a>
                    </div>
                    <div class="col-md-2">
                        <a  onclick="return markdownUpdate()" download> <button class="btn btn-danger">Export Markdown Update</button></a>
                    </div>
                    <div class="col-md-2">
                        <a  onclick="return priceAndQuantityUpdate()" download> <button class="btn btn-danger">Export Price & Quantity Update</button></a>
                    </div>
                    </div>
                <br>
                    <div  class="row">

                    <div class="col-md-3">
                        <a  onclick="return excel()"> <button class="btn btn-danger"  >Download Offers into Local Computer</button></a>

                    </div>
                    <div class="col-md-3">
                        <a  href="{{url("public/csv/OfferList.csv")}}" download > <button class="btn btn-danger">Download last exported offer file</button></a>

                    </div>
                        <div class="col-md-6"></div>
                    </div>
                <br>

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


        var selecteds = [];
        $(document).ready(function() {

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            table =  $('#offerlist').DataTable({

                processing: true,
                serverSide: true,
                stateSave: true,
                "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
//                "dom": 'lf<"br">irtip',
                "dom": 'lf<br>i<"toolbar">rtip',
                "ajax":{
                    "url": "{!! route('offer.offerList') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                        d.offer=$('#offer').val();
                        d.categoryId=$('#category').val();
                        d.productstatus=$('#product').val();
                    },
                },
                columns: [
                    { "data": function(data){
                        return '<input type="checkbox" name="selected_rows[]" class="chk" data-panel-id="'+data.offerId+'"onclick="selected_rows(this)" value="'+ data.offerId +'" />';},
                        "orderable": false, "searchable":false, "name":"selected_rows","className": "dt-center selectBox" },
                    { data: 'categoryName', name: 'categoryName' },
                    { data: 'sku', name: 'sku' },
                    { data: 'price', name: 'price' },
                    { data: 'state', name: 'state' },
                    { data: 'stockQty', name: 'stockQty' },

                    { "data": function(data){return (data.price-data.disPrice)}
                    },

                    { data: 'disStartPrice', name: 'disStartPrice' },
                    { data: 'disEndPrice', name: 'disEndPrice' },
                    { "data": function(data){
                        return '<a class="btn" data-panel-id="'+data.offerId+'"onclick="editOffer(this)"><i class="fa fa-edit"></i></a><a class="btn" data-panel-id="'+data.offerId+'"onclick="deleteOffer(this)"><i class="fa fa-trash"></i></a>';},
                        "orderable": false, "searchable":false, "name":"selected_rows" }

                ],
                order: [[0,'desc'] ],

            });
            $("div.toolbar").html('<input style="margin-left: 15px" type="checkbox" id="selectall1" /><b>Select All</b>');

            $('#offerlist').on( 'length.dt', function ( e, settings, len ) {
                selecteds=[];
                $(':checkbox:checked').prop('checked',false);
            });
            $('#offerlist').on( 'page.dt', function ( e, settings, len ) {
                selecteds=[];
                $(':checkbox:checked').prop('checked',false);
            });
            $('#offerlist').on( 'search.dt', function ( e, settings, len ) {
                selecteds=[];
                $(':checkbox:checked').prop('checked',false);
            });


            $('#category').change(function(){ //button filter event click
                table.search("").draw(); //just redraw myTableFilter
                table.ajax.reload();  //just reload table
                selecteds=[];
                // $('.SelectAll').attr('checked', false);
                $(':checkbox:checked').prop('checked',false);
            });
            $('#product').change(function(){ //button filter event click
                table.search("").draw(); //just redraw myTableFilter
                table.ajax.reload();  //just reload table
                selecteds=[];
                // $('.SelectAll').attr('checked', false);
                $(':checkbox:checked').prop('checked',false);
            });
            $('#offer').change(function(){ //button filter event click
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



                }
                else {
                    selecteds=[];
                    $(':checkbox:checked').prop('checked',false);
                }

            });

        });


        function selected_rows(x) {
            btn = $(x).data('panel-id');

            var index = selecteds.indexOf(btn.toString())

            if (index == '-1'){
                selecteds.push(btn);
            }else {
                selecteds.splice(index, 1);
            }

        }

//        function selectAll(source) {
//            for(var i=0; i <= selecteds.length; i++) {
//                selecteds.pop(i);
//            }
//            checkboxes = document.getElementsByName('selected_rows[]');
//            for(var i in checkboxes) {
//                checkboxes[i].checked = source.checked;
//            }
//
//            $(".chk:checked").each(function () {
//                selecteds.push($(this).val());
//            });
//        }

        function editOffer(x) {
            btn = $(x).data('panel-id');
            var url = '{{route("offer.edit", ":id") }}';
            //alert(url);
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;
        }
        function deleteOffer(x) {

            btn = $(x).data('panel-id');
            var url = '{{route("offer.delete", ":id") }}';

            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure you would like to delete the selected Offer?',
                icon: 'fa fa-warning',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'Yes',
                        btnClass: 'btn-red',
                        action: function(){
                            var newUrl = url.replace(':id', btn);
                            window.location.href = newUrl;
                        }
                    },
                    No: function () {

                    },
                }
            });

//            var result = confirm("Are you sure you would like to delete the selected Offer?");
//            if (result) {
//                var newUrl = url.replace(':id', btn);
//                window.location.href = newUrl;
//            }
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

            function creationFull() {
                var offers = selecteds;
                if (offers.length >0) {
                    $.ajax({
                        type: 'POST',
                        url: "{!! route('offer.csv') !!}",
                        cache: false,
                        data: {'fulloffers': offers},
                        success: function (data) {
                            $('#SessionMessage').load(document.URL +  ' #SessionMessage');
                            table.ajax.reload();  //just reload table

                            {{--var link = document.createElement("a");--}}
                            {{--link.download = data.fileName;--}}
                            {{--var uri = '{{url("public/csv")}}'+"/"+data.fileName;--}}
                            {{--link.href = uri;--}}
                            {{--document.body.appendChild(link);--}}
                            {{--link.click();--}}
                            {{--document.body.removeChild(link);--}}
                            {{--delete link;--}}

                                selecteds=[];

                            $(':checkbox:checked').prop('checked',false);


                        }

                    });
                }
                else {
                    alert("Please Select a offer first");
                }
            }

                function priceUpdate() {
                    var offers = selecteds;
                    if (offers.length >0) {
                        $.ajax({
                            type: 'POST',
                            url: "{!! route('offer.csv') !!}",
                            cache: false,
                            data: {'priceCreation': offers},
                            success: function (data) {

                                $('#SessionMessage').load(document.URL +  ' #SessionMessage');
                                table.ajax.reload();  //just reload table

                                {{--var link = document.createElement("a");--}}
                                {{--link.download = data.fileName;--}}
                                {{--var uri = '{{url("public/csv")}}'+"/"+data.fileName;--}}
                                {{--link.href = uri;--}}
                                {{--document.body.appendChild(link);--}}
                                {{--link.click();--}}
                                {{--document.body.removeChild(link);--}}
                                {{--delete link;--}}

                                    selecteds=[];

                                $(':checkbox:checked').prop('checked',false);


                            }

                        });
                    }else {
                        alert("Please Select a offer first");
                    }
                }

        function stockUpdate() {
            var offers = selecteds;
            if (offers.length >0) {
                $.ajax({
                    type: 'POST',
                    url: "{!! route('offer.csv') !!}",
                    cache: false,
                    data: {'stockUpdate': offers},
                    success: function (data) {

                        $('#SessionMessage').load(document.URL +  ' #SessionMessage');
                        table.ajax.reload();  //just reload table

                        {{--var link = document.createElement("a");--}}
                        {{--link.download = data.fileName;--}}
                        {{--var uri = '{{url("public/csv")}}'+"/"+data.fileName;--}}
                        {{--link.href = uri;--}}
                        {{--document.body.appendChild(link);--}}
                        {{--link.click();--}}
                        {{--document.body.removeChild(link);--}}
                        {{--delete link;--}}

                            selecteds=[];

                        $(':checkbox:checked').prop('checked',false);


                    }

                });
            }else {
                alert("Please Select a offer first");
            }
        }

        function markdownUpdate() {
            var offers = selecteds;
            if (offers.length >0) {
                $.ajax({
                    type: 'POST',
                    url: "{!! route('offer.csv') !!}",
                    cache: false,
                    data: {'markdownUpdate': offers},
                    success: function (data) {

                        $('#SessionMessage').load(document.URL +  ' #SessionMessage');
                        table.ajax.reload();  //just reload table

                        {{--var link = document.createElement("a");--}}
                        {{--link.download = data.fileName;--}}
                        {{--var uri = '{{url("public/csv")}}'+"/"+data.fileName;--}}
                        {{--link.href = uri;--}}
                        {{--document.body.appendChild(link);--}}
                        {{--link.click();--}}
                        {{--document.body.removeChild(link);--}}
                        {{--delete link;--}}

                            selecteds=[];

                        $(':checkbox:checked').prop('checked',false);

                    }

                });
            }else {
                alert("Please Select a offer first");
            }
        }
        function priceAndQuantityUpdate() {
            var offers = selecteds;
            if (offers.length >0) {
                $.ajax({
                    type: 'POST',
                    url: "{!! route('offer.csv') !!}",
                    cache: false,
                    data: {'priceAndQuantityUpdate': offers},
                    success: function (data) {

                        $('#SessionMessage').load(document.URL +  ' #SessionMessage');
                        table.ajax.reload();  //just reload table

                        {{--var link = document.createElement("a");--}}
                        {{--link.download = data.fileName;--}}
                        {{--var uri = '{{url("public/csv")}}'+"/"+data.fileName;--}}
                        {{--link.href = uri;--}}
                        {{--document.body.appendChild(link);--}}
                        {{--link.click();--}}
                        {{--document.body.removeChild(link);--}}
                        {{--delete link;--}}

                            selecteds=[];

                        $(':checkbox:checked').prop('checked',false);

                    }

                });
            }else {
                alert("Please Select a offer first");
            }
        }


        function excel() {


            var products=selecteds;

            //alert(products);

            if (products.length >0) {

                $.ajax({
                    type: 'POST',
                    url: "{!!route('offer.excelExport') !!}",
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