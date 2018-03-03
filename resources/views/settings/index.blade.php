@extends('main')


@section('content')

    <div class="container-fluid">
        <label class="col-sm-2 form-control-label"><b>Edit List</b></label>
        <div class="col-sm-10">
            <select id="content" class="form-control form-control-warning" required>
                <option value="">Select One</option>
                    <option value="category">Category</option>
                    <option value="color">Color</option>
                    <option value="size">Size</option>

            </select>
        </div>


        <div id="element" class="element">




        </div>




    </div>

@endsection


@section('foot-js')

    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#content").change(function() {

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var name=$(this).val();

            $.ajax({
                type:'POST',
                url:"{!! route('settings.getColors') !!}",
                cache: false,
                data:{'option':name},
                success:function(data) {

                    $("#element").html(data);


                }

            });

        });



    </script>

@endsection