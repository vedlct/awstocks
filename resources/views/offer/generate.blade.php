@extends('main')

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
                        <label class="form-control-label">Product Status</label> <br>
                        <select class="form-control" id="product" name="product">
                            <option selected value="">All Product Status</option>
                            <?php for ($i=0;$i<count(Status);$i++){?>

                            <option value="<?php echo Status[$i]?>"><?php echo Status[$i]?></option>

                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-4 dropdown">
                        <label class="form-control-label">Offer Status</label> <br>
                        <select class="form-control" id="offer" name="product">
                            <option selected value="">--Select Offer Status--</option>
                            <?php for ($i=0;$i<count(Status);$i++){?>

                            <option value="<?php echo Status[$i]?>"><?php echo Status[$i]?></option>

                            <?php } ?>
                        </select>
                    </div>

                </div>
                <br>
        <div class="table table-responsive">
         <table id="offerlist" class="table table-hover"  >
            <thead>
            <tr>

                <th>Select</th>
                {{--<th>Category</th>--}}
                <th>Sku</th>
                <th>Price</th>
                <th>State</th>
                <th>Quantity</th>
                <th>Product-Id-Type</th>
                <th>Discount Price</th>
                <th>Discount Start Date</th>
                <th>Discount End Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>


        </div>
                <a  onclick="return creationFull()" download> <button class="btn btn-danger" >CREATION #FULL</button></a>
                <a  onclick="return priceUpdate()" download> <button class="btn btn-danger"  >Price Update</button></a>
                <a  onclick="return stockUpdate()" download> <button class="btn btn-danger"  >Stock Update</button></a>
                <a  onclick="return markdownUpdate()" download> <button class="btn btn-danger"  >Markdown Update</button></a>

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

            table =  $('#offerlist').DataTable({

                processing: true,
                serverSide: true,
                stateSave: true,
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
                        return '<input type="checkbox" name="selected_rows[]" data-panel-id="'+data.offerId+'"onclick="selected_rows(this)" value="'+ data.offerId +'" />';},
                        "orderable": false, "searchable":false, "name":"selected_rows" },
//                    { data: 'categoryName', name: 'categoryName' },
                    { data: 'sku', name: 'sku' },
                    { data: 'price', name: 'price' },
                    { data: 'state', name: 'state' },
                    { data: 'stockQty', name: 'stockQty' },
                    { data: 'product-id-type', name: 'product-id-type' },
                    { data: 'disPrice', name: 'disPrice' },
                    { data: 'disStartPrice', name: 'disStartPrice' },
                    { data: 'disEndPrice', name: 'disEndPrice' },
                    { "data": function(data){
                        return '<a class="btn" data-panel-id="'+data.offerId+'"onclick="editOffer(this)"><i class="fa fa-edit"></i></a><a class="btn" data-panel-id="'+data.offerId+'"onclick="deleteOffer(this)"><i class="fa fa-trash"></i></a>';},
                        "orderable": false, "searchable":false, "name":"selected_rows" }


                ],

            });
            $('#category').change(function(){ //button filter event click
                table.search("").draw(); //just redraw myTableFilter
                table.ajax.reload();  //just reload table
            });
            $('#product').change(function(){ //button filter event click
                table.search("").draw(); //just redraw myTableFilter
                table.ajax.reload();  //just reload table
            });
            $('#offer').change(function(){ //button filter event click
                table.search("").draw(); //just redraw myTableFilter
                table.ajax.reload();  //just reload table
            });

        });

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
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;
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


                            var link = document.createElement("a");
                            link.download = "FullOfferList.csv";
                            var uri = '{{url("/csv/FullOfferList.csv")}}';
                            link.href = uri;
                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                            delete link;


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

                                var link = document.createElement("a");
                                link.download = "PriceUpdateList.csv";
                                var uri = '{{url("/csv/PriceUpdateList.csv")}}';
                                link.href = uri;
                                document.body.appendChild(link);
                                link.click();
                                document.body.removeChild(link);
                                delete link;


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

                        var link = document.createElement("a");
                        link.download = "StockUpdateList.csv";
                        var uri = '{{url("/csv/StockUpdateList.csv")}}';
                        link.href = uri;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                        delete link;


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

                        var link = document.createElement("a");
                        link.download = "markdownUpdateList.csv";
                        var uri = '{{url("/csv/markdownUpdateList.csv")}}';
                        link.href = uri;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                        delete link;

                    }

                });
            }else {
                alert("Please Select a offer first");
            }
        }
    </script>
@endsection