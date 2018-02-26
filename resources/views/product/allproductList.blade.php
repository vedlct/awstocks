@extends('main')

@section('content')

    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Product List</h2>
        </div>
    </header>


    <div class="table table-responsive" style="padding: 10px; background-color:white";>

        <div class="row">
        <div class="col-md-3 dropdown">
            <label class="form-control-label">Status</label> <br>
            <select class="form-control" id="status" name="status" onchange="status(this.value)">
                <option value="">--Select Status--</option>
                <option value="ACTIVE">Active</option>
                <option value="INACTIVE">Inactive</option></select>
        </div>
        <div class="col-md-3 dropdown">
            <label class="form-control-label">Category</label> <br>
            <select class="form-control" id="status" name="status" onchange="status(this.value)">
                <option value="">--Select Status--</option>
                <option value="ACTIVE">Active</option>
                <option value="INACTIVE">Inactive</option></select>
        </div>
        <div class="col-md-3 dropdown">
            <label class="form-control-label">Product Name</label> <br>
            <select class="form-control" id="status" name="status" onchange="status(this.value)">
                <option value="">--Select Status--</option>
                <option value="ACTIVE">Active</option>
                <option value="INACTIVE">Inactive</option></select>
        </div>

            <div class="col-md-3 form-group">
                <label class="form-control-label" >Search</label>
                <input name="line2" type="text" class="form-control required validate" onkeyup="search(this.value)">
            </div>

        </div>


        <table class="table table-hover">
            <thead>
            <tr style="color: #00aba9">
                <th>Select</th>
                <th >Product Category</th>
                <th>Style</th>
                <th>SKU</th>
                <th>Product name</th>
                <th>Brand name</th>
                <th>status</th>
                <th>Last Exported By</th>
                <th>Last Exported Date</th>
                <th style="width: 100px">Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>


        </table>




    </div>

@endsection