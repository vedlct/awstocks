@extends('main')

@section('content')
<div class="addprotitle">
    <h2 style="color: #989898; margin:10px;">Add Product Information</h2>
</div>
<div class="row">
   

   
    <div class="col-lg-8">
        <div class="card" style="margin-left: 10px;">

            <div class="card-body">

                <form class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Product category</label>
                        <div class="col-sm-9">

                            <select name="designation" class="form-control form-control-warning">
                                <option value="">Select One</option>
                                <option value="">Women</option>
                                <option value="">Men</option>
                                <option value="">Kids</option>
                            </select>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Brand Name</label>
                        <div class="col-sm-9">
                            <input id="inputHorizontalWarning" type="password" placeholder="brand" class="form-control form-control-warning">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">sku</label>
                        <div class="col-sm-9">
                            <input id="inputHorizontalWarning" type="password" placeholder="SKU" class="form-control form-control-warning">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Standard Color</label>
                        <div class="col-sm-9">

                            <select name="designation" class="form-control form-control-warning">
                                <option value="">Select One</option>
                                <option value="">Red</option>
                                <option value="">Blue</option>
                                <option value="">Green</option>

                            </select>

                        </div>
                    </div>



                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Status</label>
                        <div class="col-sm-9">

                            <select name="status" class="form-control form-control-warning">
                                <option value="">Active</option>
                                <option value="">Inactive</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Product Name</label>
                        <div class="col-sm-9">
                            <input id="inputHorizontalSuccess" type="text" placeholder="name" class="form-control form-control-success">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Style</label>
                        <div class="col-sm-9">
                            <input id="inputHorizontalSuccess" type="text" placeholder="style" class="form-control form-control-success">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Size</label>
                        <div class="col-sm-9">

                            <select name="category" class="form-control form-control-warning">
                                <option value="">Select One</option>
                                <option value="">S</option>
                                <option value="">M</option>
                                <option value="">L</option>
                                <option value="">XL</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Detailed Color</label>
                        <div class="col-sm-9">
                            <select name="status" class="form-control form-control-warning">
                                <option value="">Select One</option>
                                <option value="">Bordeaux</option>
                                <option value="">Cobalt</option>

                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Product Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="5" id="comment"></textarea>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Swatch</label>
                        <div class="col-sm-9">
                            <form action="/action_page.php">
                                <input type="file" name="pic"  value="upload Image" accept="image/*">
                            </form>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label"><b>Outfit</b> </label>
                        <div class="col-sm-9">
                            <form action="/action_page.php">
                                <input type="file" name="pic"  value="upload Image" accept="image/*">
                            </form>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label"><b>Main Image</b> </label>
                        <div class="col-sm-9">
                            <form action="/action_page.php">
                                <input type="file" name="pic"  value="upload Image" accept="image/*">
                            </form>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label"><b>Image 2</b> </label>
                        <div class="col-sm-9">
                            <form action="/action_page.php">
                                <input type="file" name="pic"  value="upload Image" accept="image/*">
                            </form>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-9 offset-sm-3">
                            <input type="submit" value="Submit" class="btn btn-primary">
                        </div>
                    </div>
                    
                </form>
                
                
                
                
            </div>
        </div>
    </div>





</div>













@endsection