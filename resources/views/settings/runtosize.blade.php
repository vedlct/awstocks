<a href="{!! route('settings.addruntosize') !!}"> <button class="btn btn-success" style="float: right">Insert Runtosize</button></a>
<br><br>
<table id="runtosizetable" class="table" >
    <thead>
    <tr>
        <th>Runtosize Name</th>
        <th>Description</th>
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

        table =  $('#runtosizetable').DataTable({

            processing: true,
            serverSide: true,
            stateSave: true,
            "ajax":{
                "url": "{!! route('settings.runtosizeajax') !!}",
                "type": "POST",
                data : {_token: CSRF_TOKEN}
            },
            columns: [
                { data: 'runToSizeName', name: 'runToSizeName' },
                { data: 'runToSizeDescription', name: 'runToSizeDescription' },
                { "data": function(data){
                    return '<a class="btn" data-panel-id="'+data.categoryId+'"onclick="editCategory(this)"><i class="fa fa-edit"></i></a><a class="btn" data-panel-id="'+data.categoryId+'"onclick="deletCategory(this)"><i class="fa fa-trash"></i></a>';},
                    "orderable": false, "searchable":false, "name":"selected_rows" }


            ],

        });


    });


    function editColor() {

    }
</script>