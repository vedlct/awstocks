@extends('main')

@section('content')

    <div class="row">

        <div class="col-lg-12">
            <div class="card" style="margin-left: 10px; border-radius: 10px;">

                <div class="card-body" style="padding: 1%;">
                    <div align="center" style="margin-bottom: 3%;">
                        <h2 style="color: #989898;"><b>Add Season</b></h2>
                    </div>
                    <form method="post" action="{{route('settings.insertSeason')}}">
                        {{csrf_field()}}

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Season Name</label>
                            <div class="col-sm-10">
                                <input id="inputHorizontalWarning" type="text" value="{{ old('seasonName') }}" name="seasonName"  class="form-control form-control-warning" required>
                                @if ($errors->has('seasonName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('seasonName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Start Date</label>
                            <div class="col-sm-10">
                                <input id="startDate" type="text" value="{{ old('startDate') }}" name="startDate"  class="form-control form-control-warning" required>
                                @if ($errors->has('startDate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('startDate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">End Date</label>
                            <div class="col-sm-10">
                                <input id="endDate" type="text" value="{{ old('endDate') }}" name="endDate"  class="form-control form-control-warning" required>
                                @if ($errors->has('endDate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('endDate')}}</strong>
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


        $( function() {
            $( "#startDate" ).datepicker();
            $( "#endDate" ).datepicker();
        } );

    </script>

@endsection