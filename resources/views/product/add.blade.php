@extends('main')

@section('content')

<div class="row">
   

   
    <div class="col-lg-12">
        <div class="card" style="margin-left: 10px; border-radius: 10px;">

            <div class="card-body" style="padding: 5%;">
                <div align="center" style="margin-bottom: 3%;">
                    <h2 style="color: #989898;"><b>Add Product Information</b></h2>
                </div>

                <form class="form-horizontal" method="post" action="{{route('product.insert')}}">
                    <div class="form-group row">
                        {{csrf_field()}}
                        <label class="col-sm-2 form-control-label">Product category</label>
                        <div class="col-sm-10">
                            <select name="category" class="form-control form-control-warning" >
                                <option value="">Select One</option>
                                <option value="1">Women</option>
                                <option value="2">Men</option>
                                <option value="3">Kids</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Brand Name</label>
                        <div class="col-sm-10">
                            <input id="inputHorizontalWarning" type="text" name="brand" placeholder="brand" class="form-control form-control-warning">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">sku</label>
                        <div class="col-sm-10">
                            <input id="inputHorizontalWarning" type="text" name="sku" placeholder="SKU" class="form-control form-control-warning">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Standard Color</label>
                        <div class="col-sm-10">
                            <select name="standardColor" class="form-control form-control-warning">
                                <option value="">Select One</option>
                                <option value="1">Red</option>
                                <option value="2">Blue</option>
                                <option value="3">Green</option>
                            </select>

                        </div>
                    </div>



                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Status</label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control form-control-warning">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Product Name</label>
                        <div class="col-sm-10">
                            <input id="inputHorizontalSuccess" type="text" name="productName" placeholder="name" class="form-control form-control-success">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Style</label>
                        <div class="col-sm-10">
                            <input id="inputHorizontalSuccess" name="style" type="text" placeholder="style" class="form-control form-control-success">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Size</label>
                        <div class="col-sm-10">

                            <select name="size" class="form-control form-control-warning">
                                <option value="">Select One</option>
                                <option value="s">S</option>
                                <option value="m">M</option>
                                <option value="l">L</option>
                                <option value="xl">XL</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Detailed Color</label>
                        <div class="col-sm-10">
                            <select name="detailedColor" class="form-control form-control-warning">
                                <option value="">Select One</option>
                                <option value="1">Bordeaux</option>
                                <option value="2">Cobalt</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Product Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" id="comment" name="description"></textarea>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Swatch</label>
                        <div class="col-sm-10">
                            <input type="file" name="pic"  value="upload Image" accept="image/*">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label"><b>Outfit</b> </label>
                        <div class="col-sm-10">
                            <input type="file" name="pic"  value="upload Image" accept="image/*">

                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label"><b>Main Image</b> </label>
                        <div class="col-sm-10">
                            <input type="file" name="pic"  value="upload Image" accept="image/*">

                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label"><b>Image 2</b> </label>
                        <div class="col-sm-10">
                            <input type="file" name="pic"  value="upload Image" accept="image/*">

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