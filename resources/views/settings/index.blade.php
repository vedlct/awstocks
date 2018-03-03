@extends('main')


@section('content')

    <div class="col-lg-12">
        <div class="card" style="margin-left: 10px; border-radius: 10px;">

            <div class="card-body" style="padding: 1%;">
                <div align="center" style="margin-bottom: 3%;">
                    <h2 style="color: #989898;"><b>Settings</b></h2>
                </div>

                <div class="container-fluid">
        <label class="col-sm-2 form-control-label"><b>Edit List</b></label>
        <div class="col-sm-10">
            <select id="content" class="form-control form-control-warning" required>
                <option value="">Select One</option>
                    <option value="category">Category</option>
                    <option value="color">Color</option>
                    <option value="size">Size</option>
                     <option value="size">Care</option>
                    <option value="size">Run TO Size</option>

            </select>
        </div>
        <br>


        <div id="element" class="element">




        </div>




        </div>
            </div>
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