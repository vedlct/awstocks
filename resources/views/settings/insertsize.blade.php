@extends('main')

@section('content')

    <div class="row">


        <div class="col-lg-12">
            <div class="card" style="margin-left: 10px; border-radius: 10px;">

                <div class="card-body" style="padding: 1%;">
                    <div align="center" style="margin-bottom: 3%;">
                        <h2 style="color: #989898;"><b>Add Size {{$sizeType}}</b></h2>
                    </div>
                    <form method="post" action="{{route('settings.insertSize')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="sizeType" value="{{$sizeType}}">
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Size Name</label>
                            <div class="col-sm-10">
                                <input id="inputHorizontalWarning" type="text" name="sizeName"  class="form-control form-control-warning" required>
                                @if ($errors->has('sizeName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sizeName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Size Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" id="comment" name="sizeDescription" required></textarea>
                                @if ($errors->has('sizeDescription'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sizeDescription') }}</strong>
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


@endsection