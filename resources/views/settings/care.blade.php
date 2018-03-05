<a href="{!! route('settings.addcare') !!}"> <button class="btn btn-success" style="float: right">Insert Care</button></a>
<br><br>
<table id="caretable" class="table" >
    <thead>
    <tr>
        <th>Care Name</th>
        <th>Description</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<script src="{{url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />.
<script>

    $(document).ready(function() {

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        table =  $('#caretable').DataTable({

            processing: true,
            serverSide: true,
            stateSave: true,
            "ajax":{
                "url": "{!! route('settings.careajax') !!}",
                "type": "POST",
                data : {_token: CSRF_TOKEN}
            },
            columns: [
                { data: 'careName', name: 'careName' },
                { data: 'careDescription', name: 'careDescription' },
                { "data": function(data){
                    return '<a class="btn" data-panel-id="'+data.careId+'"onclick="editCare(this)"><i class="fa fa-edit"></i></a><a class="btn" data-panel-id="'+data.careId+'"onclick="deleteCare(this)"><i class="fa fa-trash"></i></a>';},
                    "orderable": false, "searchable":false, "name":"selected_rows" }


            ],

        });


    });


    function editCare(x) {
        btn = $(x).data('panel-id');
        var url = '{{route("edit.care", ":id") }}';
        //alert(url);
        var newUrl=url.replace(':id', btn);
        window.location.href = newUrl;
    }

    function deleteCare(x) {
        btn = $(x).data('panel-id');
        var url = '{{route("care.destroy", ":id") }}';
        //alert(url);
        var result = confirm("Want to delete?");
        if (result) {
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;}
    }
</script>