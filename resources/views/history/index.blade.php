@extends('main')

@section('content')
    <div  style="padding: 10px; background-color:white";>
    <!-- Page Header-->
        <div class="col-md-4 dropdown">
            <label class="form-control-label">Select Type</label> <br>
            <select class="form-control" id="category" name="category">
                <option selected value="">All Type</option>

                @foreach(LISTTYPE as $l)
                    <option value="{{$l}}">{{$l}}</option>
                @endforeach
            </select>
        </div>

    <div class="table table-responsive" style="margin-top: 20px">
        <table id="allProductList" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th >select</th>
                <th >File Name</th>
                <th >File Type</th>
                <th >Created By</th>
                <th >Created At</th>
                <th >Action</th>
            </tr>
            </thead>

        </table>
        <input type="checkbox" id="selectall" onClick="selectAll(this)" /><b>Select All</b><br>
        <a  onclick="return myfunc()" download> <button class="btn btn-danger"  >Export Products file</button></a>
        <br>


    </div></div>




@endsection
@section('foot-js')
    <script src="{{url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script>
        var table;
        $(document).ready(function() {

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            table = $('#allProductList').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
//                bSort:false,
                "ajax":{
                    "url": "{!! route('history.data') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                        d.categoryId=$('#category').val();
                    },
                },
                columns: [
                    { "data": function(data){
                        return '<input data-panel-id="{{url("public/csv")}}'+"/"+data.historicUploadedFilesName+'"onclick="selected_rows(this)" type="checkbox" class="chk" name="selected_rows[]" value="{{url("public/csv")}}'+"/"+ data.historicUploadedFilesName +'" />';},
                        "orderable": false, "searchable":false, "name":"selected_rows",},

                    { data: 'historicUploadedFilesName',name:'historicUploadedFilesName' },
                    { data: 'historicUploadedFilesType',name:'historicUploadedFilesType' },
                    { data: 'createdBy',name:'createdBy' },
                    { data: 'createDate',name:'createDate' },


                    { "data": function(data){

                    return '<a class="btn btn-default btn-sm" href="{{url("public/csv")}}'+"/"+data.historicUploadedFilesName+'" download><i class="fa fa-edit"></i></a>';},
                        "orderable": false, "searchable":false },
                ],
                order: [[0,'desc'] ],
            });

            $('#category').change(function(){ //button filter event click
                table.search("").draw(); //just redraw myTableFilter
                table.ajax.reload();  //just reload table
            });



        });

        var selecteds = [];
        function selected_rows(x) {
                btn = $(x).data('panel-id');
                alert(btn);
//                var index = selecteds.indexOf(btn)
//                if (index == "-1"){
//                    selecteds.push(btn);
//                }else {
//
//                    selecteds.splice(index, 1);
//                }
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

            alert(selecteds);
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

                       

                    }

                });
            }
            else {
                alert("Please Select a product first");
            }
        }

        </script>



@endsection