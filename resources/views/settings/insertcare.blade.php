@extends('main')

@section('content')


    <div class="row">


        <div class="col-lg-12">
            <div class="card" style="margin-left: 10px; border-radius: 10px;">

                <div class="card-body" style="padding: 1%;">
                    <div align="center" style="margin-bottom: 3%;">
                        <h2 style="color: #989898;"><b>Add Care </b></h2>
                    </div>
                    <form method="post" action="{{route('settings.insertCare')}}">
                        {{csrf_field()}}

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Care Name</label>
                            <div class="col-sm-10">
                                <input id="inputHorizontalWarning" type="text" value="{{ old('careName') }}" name="careName"  class="form-control form-control-warning" required>

                                @if ($errors->has('careName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('careName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Care Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" id="comment" name="careDescription" >{{ old('careDescription') }}</textarea>
                                @if ($errors->has('careDescription'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('careDescription') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-3">
                                <input type="submit" value="Submit" class="btn btn-primary">
                            </div>
                        </div>


                    </form>

                </div>
            </div>
        </div>





    </div>


@endsection
@section('foot-js')
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script>


        $("#category").change(function() {

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var type=$(this).val();

            $.ajax({
                type : 'post' ,
                url : '{{route('getProductByCategory')}}',
                data : {_token: CSRF_TOKEN,'category':type} ,
                success : function(data){
//                    console.log(data);
                    document.getElementById("product").innerHTML = data;

                }
            });
        });


        function setTwoNumberDecimal(event) {
            this.value = parseFloat(this.value).toFixed(2);
        }

        $( function() {
            $( "#fromdate" ).datepicker();
            $( "#todate" ).datepicker();
        } );

    </script>

@endsection