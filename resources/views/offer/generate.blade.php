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
                            <option selected value="">All Product</option>
                            @foreach($productStatus as $products)
                                <option value="{{$products->status}}">{{$products->status}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 dropdown">
                        <label class="form-control-label">Offer Status</label> <br>
                        <select class="form-control" id="offer" name="product">
                            <option selected value="">--Select Offer Status--</option>
                            @foreach($offerStatus as $offer)
                                <option value="{{$offer->status}}">{{$offer->status}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <br>
        <div class="table table-responsive">
         <table id="offerlist" class="table table-hover"  >
            <thead>
            <tr>

                <th>Select</th>
                <th>Category</th>
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
//                columnDefs: [ {
//                    orderable: false,
//                    className: 'select-checkbox',
//                    targets:   0
//                } ],
//                select: {
//                    style:    'os',
//                    selector: 'td:first-child'
//                },
                columns: [
                    { "data": function(data){
                        return '<input type="checkbox" name="selected_rows[]" value="'+ data.offerId +'" />';},
                        "orderable": false, "searchable":false, "name":"selected_rows" },
                    { data: 'categoryName', name: 'categoryName' },
                    { data: 'sku', name: 'sku' },
                    { data: 'price', name: 'price' },
                    { data: 'state', name: 'state' },
                    { data: 'quantity', name: 'quantity' },
                    { data: 'product-id-type', name: 'product-id-type' },
                    { data: 'disPrice', name: 'disPrice' },
                    { data: 'disStartPrice', name: 'disStartPrice' },
                    { data: 'disEndPrice', name: 'disEndPrice' },
                    { "data": function(data){
                        return '<input type="button" name="editOffer" onclick="editoffer(this)" data-panel-id="'+ data.offerId +'" />';},
                        "orderable": false, "searchable":false, "name":"action" }


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

        function editoffer(x) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            btn = $(x).data('panel-id');
          //  alert(btn);

            $.ajax({
                type:'POST',
                url:'{!! route('offer.editoffer') !!}',
                data:{id:btn,_token: CSRF_TOKEN},
                cache: false,
                success:function(data) {
                    //$('#txtHint').html(data);
                    alert(data);

                }
            });
        }
    </script>
@endsection