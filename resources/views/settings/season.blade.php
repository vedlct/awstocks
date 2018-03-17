<a href="{!! route('settings.addSeason') !!}"> <button class="btn btn-success" style="float: right">Insert Season</button></a>
<br><br>
<table id="season" class="table" >
    <thead>
    <tr>
        <th>Season Name</th>
        <th>Start Date</th>
        <th>End Date</th>
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

        table =  $('#season').DataTable({

            processing: true,
            serverSide: true,
            stateSave: true,
            "ajax":{
                "url": "{!! route('settings.season') !!}",
                "type": "POST",
                data : {_token: CSRF_TOKEN}
            },
            columns: [
                { data: 'seasonName', name: 'seasonName' },
                { data: 'startDate', name: 'startDate' },
                { data: 'endDate', name: 'endDate' },
                { "data": function(data){
                    return '<a class="btn" data-panel-id="'+data.seasonId+'"onclick="editruntosize(this)"><i class="fa fa-edit"></i></a>';},
                    "orderable": false, "searchable":false, "name":"selected_rows" }
            ],

        });


    });


    function editruntosize(x) {
        btn = $(x).data('panel-id');
        var url = '{{route("edit.season", ":id") }}';
        //alert(url);
        var newUrl=url.replace(':id', btn);
        window.location.href = newUrl;
    }


</script>