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
                <option selected value="">--Select Status--</option>
                <?php for ($i=0;$i<count(Status);$i++){?>

                <option value="<?php echo Status[$i]?>"><?php echo Status[$i]?></option>

              <?php } ?>

            </select>

        </div>
        <div class="col-md-3 dropdown">
            <label class="form-control-label">Category</label> <br>
            <select class="form-control" id="status" name="status" onchange="status(this.value)">
                <option value="">--Select Status--</option>

                @foreach($categories as $category)
                    <option value="{{$category->categoryId}}">{{$category->name}}</option>
                @endforeach
            </select>

        </div>
        <div class="col-md-3 dropdown">
            <label class="form-control-label">Product Name</label> <br>
            <select class="form-control" id="status" name="status" onchange="status(this.value)">
                <option value="">--Select Status--</option>
                @foreach($productsList as $products)
                    <option value="{{$products->productId}}">{{$products->productName}}</option>
                @endforeach
            </select>
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
            @foreach($productsList as $products)
            <tr>
                <td><input type="checkbox"></td>
                <td><?php echo $products->categoryName?></td>
                <td>{{$products->style}}</td>
                <td>{{$products->sku}}</td>
                <td>{{$products->productName}}</td>
                <td>{{$products->brand}}</td>
                <td>{{$products->status}}</td>
                <td>{{$products->LastExportedBy}}</td>
                <td>{{$products->LastExportedDate}}</td>

                <td>
                    <a href="#"> <i class="fa fa-pencil-square-o" aria-hidden="true" style="color: red"></i></a> &nbsp;&nbsp;&nbsp;
                    <a data-panel-id="#" id="myBtn2" onClick=""> <i class="fa fa-trash-o" aria-hidden="true" style="color: red"></i></a> &nbsp;&nbsp;&nbsp;
                </td>

            </tr>
            @endforeach

            </tbody>


        </table>

        <a href="csv/product.csv" onclick="return myfunc()" download> <button  class="btn btn-danger"  >Export Products file</button></a>




    </div>

@endsection