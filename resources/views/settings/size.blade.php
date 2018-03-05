<label class="col-sm-2 form-control-label"><b>Select Size Category</b></label>

<div class="col-sm-10">
    <select id="sizecat" class="form-control form-control-warning" required>
        <option value="">Select One</option>
        @foreach(SizeCategory as $value)
            <option value="{{$value}}">{{$value}}</option>
        @endforeach

    </select>
</div>
<br><br>
<form method="post" action="{{route('settings.addsize')}}" style="text-align: right; display: none" id="addform">
    {{csrf_field()}}
    <input type="hidden" name="type" id="sizetypes">
    <button type="submit" class="btn btn-success">Add Size</button>

</form>


<br><br>
<table id="sizetable" class="table" >
    <thead>
    <tr>
        <th>Color Name</th>
        <th>Description</th>
    </tr>
    </thead>
    <tbody>
    {{--@foreach($colors as $color)--}}
    {{--<tr>--}}
    {{--<td>{{$color->colorName}}</td>--}}
    {{--<td>{{$color->colorDescription}}</td>--}}
    {{--<td>{{$color->colorType}}</td>--}}
    {{--</tr>--}}
    {{--@endforeach--}}

    </tbody>
</table>

<meta name="csrf-token" content="{{ csrf_token() }}" />.
<script src="{{url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script>


    var table = $('#sizetable');


    $("#sizecat").change(function() {
        var type=$(this).val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        if(type !=''){
            $('#addform').show();
            $('#sizetypes').val(type);

        }
        else {
            $('#addform').hide();
        }



       table.DataTable({

            processing: true,
            serverSide: true,
            stateSave: true,
            bDestroy: true,
            "ajax":{
                "url": "{!! route('settings.sizeajax') !!}",
                "type": "POST",
                data : {_token: CSRF_TOKEN,'type':type}
            },
            columns: [
                { data: 'sizeName', name: 'sizeName' },
                { data: 'sizeDescription', name: 'sizeDescription' },

//                { "data": function(data){
//                    return '<a class="btn" data-panel-id="'+data.offerId+'"onclick="editColor(this)"><i class="fa fa-edit"></i></a><a class="btn" data-panel-id="'+data.offerId+'"onclick="deleteOffer(this)"><i class="fa fa-trash"></i></a>';},
//                    "orderable": false, "searchable":false, "name":"selected_rows" }


            ],

        });

    });

    {{--$(document).ready(function() {--}}
        {{--var type=$('#sizecat').val();--}}

            {{--var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');--}}

            {{--table = $('#sizetable').DataTable({--}}

                {{--processing: true,--}}
                {{--serverSide: true,--}}
                {{--stateSave: true,--}}
                {{--"ajax": {--}}
                    {{--"url": "{!! route('settings.sizeajax') !!}",--}}
                    {{--"type": "POST",--}}
                    {{--data: {_token: CSRF_TOKEN, 'type': type}--}}
                {{--},--}}
                {{--columns: [--}}

                    {{--{data: 'sizeName', name: 'sizeName'},--}}
                    {{--{data: 'sizeDescription', name: 'sizeDescription'},--}}

{{--//                { "data": function(data){--}}
{{--//                    return '<a class="btn" data-panel-id="'+data.offerId+'"onclick="editColor(this)"><i class="fa fa-edit"></i></a><a class="btn" data-panel-id="'+data.offerId+'"onclick="deleteOffer(this)"><i class="fa fa-trash"></i></a>';},--}}
{{--//                    "orderable": false, "searchable":false, "name":"selected_rows" }--}}


                {{--],--}}

            {{--});--}}

        {{--$('#sizecat').change(function(){ //button filter event click--}}
            {{--table.search("").draw(); //just redraw myTableFilter--}}
            {{--table.ajax.reload();  //just reload table--}}
        {{--});--}}


    {{--});--}}

</script>





















