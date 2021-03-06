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
                    return '<a class="btn" data-panel-id="'+data.runToSizeId+'"onclick="editruntosize(this)"><i class="fa fa-edit"></i></a><a class="btn" data-panel-id="'+data.runToSizeId+'"onclick="deleteruntosize(this)"><i class="fa fa-trash"></i></a>';},
                    "orderable": false, "searchable":false, "name":"selected_rows" }


            ],

        });


    });


    function editruntosize(x) {
        btn = $(x).data('panel-id');
        var url = '{{route("edit.runToSize", ":id") }}';
        //alert(url);
        var newUrl=url.replace(':id', btn);
        window.location.href = newUrl;
    }

    function deleteruntosize(x) {
        btn = $(x).data('panel-id');
        var url = '{{route("runtosize.destroy", ":id") }}';
        //alert(url);
        var result = confirm("Want to delete?");
        if (result) {
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;}
    }
</script>