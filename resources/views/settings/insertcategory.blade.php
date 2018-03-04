@extends('main')

@section('content')

    <div class="row">


        <div class="col-lg-12">
            <div class="card" style="margin-left: 10px; border-radius: 10px;">

                <div class="card-body" style="padding: 1%;">
                    <div align="center" style="margin-bottom: 3%;">
                        <h2 style="color: #989898;"><b>Add Caregory </b></h2>
                    </div>
                    <form method="post" action="{{route('settings.insertCategory')}}">

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Caregory Name</label>
                            <div class="col-sm-10">
                                <input id="inputHorizontalWarning" type="text" name="caregoryname"  class="form-control form-control-warning" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Caregory Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" id="comment" name="description" required></textarea>
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