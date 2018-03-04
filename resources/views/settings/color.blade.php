<a href="{!! route('settings.addcolor') !!}"><button class="btn btn-success" style="float: right">Insert Color</button></a>
<br><br>
<table id="colortable" class="table" >
    <thead>
    <tr>
        <th>Color Name</th>
        <th>Description</th>
        <th>Type</th>
        <th>Action</th>
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
<script src="{{url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />.
<script>

    $(document).ready(function() {

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        table =  $('#colortable').DataTable({

            processing: true,
            serverSide: true,
            stateSave: true,
            "ajax":{
                "url": "{!! route('settings.colorajax') !!}",
                "type": "POST",
                    data : {_token: CSRF_TOKEN}
            },
            columns: [
                { data: 'colorName', name: 'colorName' },
                { data: 'colorDescription', name: 'colorDescription' },
                { data: 'colorType', name: 'colorType' },
                { data: 'colorType', name: 'colorType' },
//                { "data": function(data){
//                    return '<a class="btn" data-panel-id="'+data.offerId+'"onclick="editColor(this)"><i class="fa fa-edit"></i></a><a class="btn" data-panel-id="'+data.offerId+'"onclick="deleteOffer(this)"><i class="fa fa-trash"></i></a>';},
//                    "orderable": false, "searchable":false, "name":"selected_rows" }


            ],

        });


    });

    
    function editColor() {
        
    }
</script>