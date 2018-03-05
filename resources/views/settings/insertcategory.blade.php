@extends('main')

@section('content')

    <div class="row">


        <div class="col-lg-12">
            <div class="card" style="margin-left: 10px; border-radius: 10px;">

                <div class="card-body" style="padding: 1%;">
                    <div align="center" style="margin-bottom: 3%;">
                        <h2 style="color: #989898;"><b>Add Category </b></h2>
                    </div>
                    <form method="post" action="{{route('settings.insertCategory')}}">
                        {{csrf_field()}}

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Category Name</label>
                            <div class="col-sm-10">
                                <input id="inputHorizontalWarning" type="text" value="{{ old('categoryName') }}" name="categoryName"  class="form-control form-control-warning" required>
                                @if ($errors->has('categoryName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('categoryName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Category Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" id="comment" name="categoryDesc" required>{{ old('categoryDesc') }}</textarea>
                                @if ($errors->has('categoryDesc'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('categoryDesc') }}</strong>
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