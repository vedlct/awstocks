@extends('main')
@section('header')
    {{--<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">--}}
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
                <select class="form-control" id="category" name="category">
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
                    <th >Select</th>
                    <th >Product Category</th>
                    <th >Product name</th>
                    <th >SKU</th>
                    <th >Last Exported Date</th>

                </tr>
                </thead>

            </table><br>


            <input type="checkbox" id="selectall" onClick="selectAll(this)" /><b>Select All</b><br>
        </div>
        <div class="row">
        <div class="col-md-4 dropdown">
            <label class="form-control-label">Season</label> <br>
            <select class="form-control" id="season" name="season" required>
                <option selected value="">All Season</option>

                @foreach($season as $season)
                    <option value="{{$season->seasonId}}">{{$season->seasonName}}</option>
                @endforeach
            </select>

        </div>
        <div class="col-md-4 ">
            <label class="form-control-label">Discount Price</label> <br>
            <input class="form-control" type="number" id="disprice" name="disprice">

        </div>
        </div>


        <br>
        <a onclick="insertBulkOffer()"><button class="btn btn-danger"  >Insert Bulk Offer</button></a>


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
                        "orderable": false, "searchable":false, "name":"selected_rows",},
                    { data: 'categoryName',name:'categoryName' },
                    { data: 'productName', name: 'productName' },
                    { data: 'sku', name: 'sku' },
                    { data: 'LastExportedDate', name: 'LastExportedDate' },

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

        function insertBulkOffer() {

            var products=selecteds;

           // alert(products);

            if (products.length >0) {

                var disprice=document.getElementById('disprice').value;
                var season=document.getElementById('season').value;

                $.ajax({
                    type: 'POST',
                    url: "{!! route('offer.insertBulkOffer') !!}",
                    cache: false,
                    data: {'offers': products,'season':season,'disprice':disprice},
                    success: function (data) {

                        if (data.returntype == "0"){
                            alert('discount price should be less than '+data.productName + ' price');
                        }
                        location.reload();
                       // alert(data);

                    }

                });
            }
            else {
                alert("Please Select a product first");
            }
        }
    </script>

@endsection




