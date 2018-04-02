@extends('main')

@section('header')
    <style>

        table{font-size: 15px}
        .container-fluid  {padding: 15px  5px;}
    </style>
@endsection
@section('content')

    <div class="row">
    <div class="col-lg-12">
        <div class="card" style="margin-left: 10px; border-radius: 10px;">

            <div class="card-body" style="padding: 1%;">
                <div align="center" style="margin-bottom: 3%;">
                    <h2 style="color: #989898;"><b>Settings</b></h2>
                </div>

                <div class="container-fluid">
        <label class="col-sm-2 form-control-label"><b>Select List</b></label>
        <div class="col-sm-10">
            <select id="content" class="form-control form-control-warning" required>
                <option value="">Select One</option>
                <?php for($i=0;$i<count(SettingListDropdown);$i++){?>
                <option @if( Session::has('Cat') && Session::get('Cat')== SettingListDropdown[$i]) selected @endif value="<?php echo SettingListDropdown[$i]?>"><?php echo ucfirst(SettingListDropdown[$i])?></option>
                <?php } ?>

            </select>
        </div>
        <br>

        <div id="element" class="element">

        </div>
        </div>
        </div>
        </div>
    </div>
    </div>

@endsection


@section('foot-js')

    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <script>

        $(document).ready(function() {

            var type ='{{Session::get('Cat')}}';
            var sizeType ='{{Session::get('sizeType')}}';
            if( type != "" && type == "size") {
                changeContent(type,sizeType);
            }if ( type != "" && type != "size"){

                changeContenttype(type);

            }
        });


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

        function changeContent(s,t) {

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type:'POST',
                url:"{!! route('settings.getColors') !!}",
                cache: false,
                data:{'option':s,'sizeType':t},
                success:function(data) {
                    $("#element").html(data);

                }
            });


        }

        function changeContenttype(s) {

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type:'POST',
                url:"{!! route('settings.getColors') !!}",
                cache: false,
                data:{'option':s},
                success:function(data) {
                    $("#element").html(data);

                }
            });

        }



    </script>

@endsection