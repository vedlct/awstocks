@extends('main')

@section('content')

<div class="row">
   

   
    <div class="col-lg-12">
        <div class="card" style="margin-left: 10px; border-radius: 10px;">

            <div class="card-body" style="padding: 1%;">
                <div align="center" style="margin-bottom: 3%;">
                    <h2 style="color: #989898;"><b>Add Product Information</b></h2>
                </div>

                <form class="form-horizontal" method="post" action="{{route('product.insert')}}" enctype="multipart/form-data">
                    <div class="form-group row">
                        {{csrf_field()}}
                        <label class="col-sm-2 form-control-label">Product category</label>
                        <div class="col-sm-10">
                            <select name="category" class="form-control form-control-warning" required>
                                <option value="">Select One</option>
                                @foreach($categories as $category)
                                <option value="{{$category->categoryId}}">{{$category->categoryName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Brand Name</label>
                        <div class="col-sm-10">
                            <input id="inputHorizontalWarning" type="text" name="brand" placeholder="brand" class="form-control form-control-warning" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">sku</label>
                        <div class="col-sm-10">
                            <input id="inputHorizontalWarning" type="text" name="sku" placeholder="SKU" class="form-control form-control-warning" required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Color</label>
                        <div class="col-sm-10">
                            <select name="color" class="form-control form-control-warning" required>
                                <option value="">Select One</option>
                                @foreach($sColors as $color)
                                <option value="{{$color->colorName}}">{{$color->colorName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Color Description</label>
                        <div class="col-sm-10">
                            <input id="inputHorizontalWarning" type="text" name="colorDesc" placeholder="Color Description" class="form-control form-control-warning" required>
                        </div>
                    </div>



                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Product Name</label>
                        <div class="col-sm-10">
                            <input id="inputHorizontalSuccess" type="text" name="productName" placeholder="name" class="form-control form-control-success" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Style</label>
                        <div class="col-sm-10">
                            <input id="inputHorizontalSuccess" name="style" type="text" placeholder="style" class="form-control form-control-success" required>
                        </div>
                    </div>



                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Size Type</label>
                        <div class="col-sm-4">
                            <select name="sizeType" class="form-control form-control-warning" id="sizeType"  required >
                                <option value="">Select One</option>
                                @foreach($sizeTypes as $size)
                                    <option value="{{$size->sizeType}}">{{$size->sizeType}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Size</label>
                        <div class="col-sm-4">
                            <select name="size" id="size" class="form-control form-control-warning" required>
                                <option value="">Select One</option>
                            </select>
                        </div>
                    </div>




                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Run to Size</label>
                        <div class="col-sm-4">
                            <select name="runToSize" class="form-control form-control-warning" required>
                                <option value="">Select One</option>
                                @foreach($runToSizes as $value)
                                    <option value="{{$value->runToSizeName}}">{{$value->runToSizeName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Care</label>
                        <div class="col-sm-4">
                            <select name="care" class="form-control form-control-warning" required>
                                <option value="">Select One</option>
                                @foreach($cares as $care)
                                    <option value="{{$care->careName}}">{{$care->careName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Ean</label>
                        <div class="col-sm-10">
                            <input id="inputHorizontalSuccess" name="ean" type="text" placeholder="ean" class="form-control form-control-success" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Price</label>
                        <div class="col-sm-10">
                            <input id="inputHorizontalSuccess" name="price" type="number" placeholder="price" class="form-control form-control-success" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Stock Qty</label>
                        <div class="col-sm-10">
                            <input id="inputHorizontalSuccess" name="stockQty" type="number" placeholder="quantity" class="form-control form-control-success" required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Min Qty Alert</label>
                        <div class="col-sm-10">
                            <input id="inputHorizontalSuccess" name="minQtyAlert" type="number" placeholder="alert quantity" class="form-control form-control-success" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Product Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" id="comment" name="description" required></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Status</label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control form-control-warning" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label"><b>Swatch</b></label>
                        <div class="col-sm-10">
                            <input type="file" name="swatchPic"  value="upload Image" accept=".jpg, .jpeg" id="swatchPic">
                            <img height="50px" width="50px" id="imgSwatchPic">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label"><b>Outfit</b> </label>
                        <div class="col-sm-10">
                            <input type="file" name="outfitPic"  value="upload Image"  accept=".jpg, .jpeg" id="outfitPic">
                            <img height="50px" width="50px" id="imgOutfitPic">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label"><b>Main Image</b> </label>
                        <div class="col-sm-10">
                            <input type="file" name="mainPic"  value="upload Image"  accept=".jpg,.jpeg" id="mainPic">
                            <img height="50px" width="50px" id="imgMainPic">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label"><b>Image 2</b> </label>
                        <div class="col-sm-10">
                            <input type="file" name="image2Pic" value="image2Pic" accept=".jpg, .jpeg" id="image2Pic">
                            <img height="50px" width="50px" id="imgImage2Pic">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label"><b>Image 3</b> </label>
                        <div class="col-sm-10">
                            <input type="file" name="image3Pic" value="image3Pic"  accept=".jpg, .jpeg" id="image3Pic">
                            <img height="50px" width="50px" id="imgImage3Pic">
                        </div>
                    </div>



                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label"><b>Image 4</b> </label>
                        <div class="col-sm-10">
                            <input type="file" name="image4Pic" value="image4Pic"  accept=".jpg,.jpeg" id="image4Pic">
                            <img height="50px" width="50px" id="imgImage4Pic">
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

        $("#sizeType").change(function() {

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var type=$(this).val();
            $.ajax({
                type : 'post' ,
                url : '{{route('getSizeByType')}}',
                data : {_token: CSRF_TOKEN,'type':type} ,
                success : function(data){
                    //console.log(data);
                    document.getElementById("size").innerHTML = data;

                }
            });
        });

        function swatchPic(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgSwatchPic').attr('src', e.target.result);}
                reader.readAsDataURL(input.files[0]);}
        }


        function swatchPic(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgSwatchPic').attr('src', e.target.result);}
                reader.readAsDataURL(input.files[0]);}
        }

        function outfitPic(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgOutfitPic').attr('src', e.target.result);}
                reader.readAsDataURL(input.files[0]);}
        }

        function mainPic(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgMainPic').attr('src', e.target.result);}
                reader.readAsDataURL(input.files[0]);}
        }

        function image2Pic(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgImage2Pic').attr('src', e.target.result);}
                reader.readAsDataURL(input.files[0]);}
        }

        function image3Pic(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgImage3Pic').attr('src', e.target.result);}
                reader.readAsDataURL(input.files[0]);}
        }


        function image4Pic(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgImage4Pic').attr('src', e.target.result);}
                reader.readAsDataURL(input.files[0]);}
        }



        $("#swatchPic").change(function(){
            swatchPic(this);
        });
        $("#outfitPic").change(function(){
            outfitPic(this);
        });

        $("#mainPic").change(function(){
            mainPic(this);
        });

        $("#image2Pic").change(function(){
            image2Pic(this);
        });
        $("#image3Pic").change(function(){
            image3Pic(this);
        });
        $("#image4Pic").change(function(){
            image4Pic(this);
        });

    </script>

@endsection