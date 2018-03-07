@extends('main')

@section('content')

    <div class="row">

        <div class="col-lg-12">
            <div class="card" style="margin-left: 10px; border-radius: 10px;">

                <div class="card-body" style="padding: 1%;">
                    <div align="center" style="margin-bottom: 3%;">
                        <h2 style="color: #989898;"><b>Add Run To Size </b></h2>
                    </div>
                    <form method="post" action="{{route('update.runToSize')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$runToSize->runToSizeId}}">
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Run To Size Name</label>
                            <div class="col-sm-10">
                                <input id="inputHorizontalWarning" type="text" name="runToSizeName" value="{{$runToSize->runToSizeName}}"  class="form-control form-control-warning" required>
                                @if ($errors->has('runToSizeName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('runToSizeName')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Run To Size Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" id="comment" name="runToSizeDescription" >{{$runToSize->runToSizeDescription}}</textarea>
                                @if ($errors->has('runToSizeDescription'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('runToSizeDescription')}}</strong>
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