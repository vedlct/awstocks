<a href="{!! route('settings.addcategory') !!}"><button class="btn btn-success" style="float: right">Insert Category</button></a>
<br><br>
<table id="categorytable" class="table" >
    <thead>
    <tr>
        <th>Category Name</th>
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

        table =  $('#categorytable').DataTable({

            processing: true,
            serverSide: true,
            stateSave: true,
            "ajax":{
                "url": "{!! route('settings.categoryajax') !!}",
                "type": "POST",
                data : {_token: CSRF_TOKEN}
            },
            columns: [
                { data: 'categoryName', name: 'categoryName' },
                { data: 'categoryDesc', name: 'categoryDesc' },
                { "data": function(data){
                    return '<a class="btn" data-panel-id="'+data.categoryId+'"onclick="editCategory(this)"><i class="fa fa-edit"></i></a>';},
                    "orderable": false, "searchable":false, "name":"selected_rows" }


            ],

        });


    });


    function editCategory(x) {
        btn = $(x).data('panel-id');
        var url = '{{route("edit.category", ":id") }}';
        //alert(url);
        var newUrl=url.replace(':id', btn);
        window.location.href = newUrl;

    }

    

</script>