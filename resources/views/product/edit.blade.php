@extends('main')

@section('content')

    <div class="row">





        <div class="col-lg-12">
            <div class="card" style="margin-left: 10px; border-radius: 10px;">

                <div class="card-body" style="padding: 1%;">
                    <div align="center" style="margin-bottom: 3%;">
                        <h2 style="color: #989898;"><b>Edit Product Information</b></h2>
                    </div>

                    <form class="form-horizontal" method="post" action="{{route('product.update')}}" enctype="multipart/form-data">
                        <div class="form-group row">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$id}}">
                            <label class="col-sm-2 form-control-label">Product category<span style="color: red" class="required">*</span></label>

                            <div class="col-sm-10">
                                <select name="category" class="form-control form-control-warning" required>
                                    <option value="">Select One</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->categoryId}}"
                                                    @if($category->categoryId == $product->fkcategoryId)
                                                    selected
                                                    @endif
                                            >{{$category->categoryName}}</option>

                                    @endforeach
                                </select>
                                @if ($errors->has('category'))
                                    <span class="help-block" style="position: absolute; left: 150px; color: red; font-size:14px">
                                    <strong>{{ $errors->first('category') }}</strong>
							</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Brand Name<span style="color: red" class="required">*</span></label>

                            <div class="col-sm-10">
                                <input id="inputHorizontalWarning" type="text"  name="brand" placeholder="brand" maxlength="45" placeholder="45 characters maximum" class="form-control form-control-warning" value="{{$product->brand}}" required>
                                @if ($errors->has('brand'))
                                    <span class="help-block" style="position: absolute; left: 150px; color: red; font-size:14px">
								<strong>{{ $errors->first('brand') }}</strong>
							</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">sku<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <input id="inputHorizontalWarning" type="text" name="sku" maxlength="20" placeholder="20 characters maximum" class="form-control form-control-warning" value="{{$product->sku}}" required>
                                @if ($errors->has('category'))
                                    <span class="help-block" style="position: absolute; left: 150px; color: red; font-size:14px">
								<strong>{{ $errors->first('category') }}</strong>
							</span> @endif
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Color<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <select name="color" class="form-control form-control-warning" required>
                                    <option value="">Select One</option>
                                    @foreach($sColors as $color)
                                        <option value="{{$color->colorId}}"
                                                @if($color->color == $product->colorName)
                                                selected
                                                @endif
                                        >{{$color->colorName}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('standardColor'))
                                    <span class="help-block" style="position: absolute; left: 150px; color: red; font-size:14px">
								<strong>{{ $errors->first('standardColor') }}</strong>
							</span> @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Color Description<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <input id="inputHorizontalWarning" type="text"  name="colorDesc" value="{{$product->colorDesc}}" maxlength="20" placeholder="20 characters maximum" class="form-control form-control-warning" required>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Product Name<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <input id="inputHorizontalSuccess" type="text"  name="productName" placeholder="name" maxlength="70" placeholder="70 characters maximum" class="form-control form-control-success" value="{{$product->productName}}" required>
                                @if ($errors->has('productName'))
                                    <span class="help-block" style="position: absolute; left: 150px; color: red; font-size:14px">
								<strong>{{ $errors->first('productName') }}</strong>
							</span> @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Style<span style="color: red" class="required">*</span></label>
                            @if ($errors->has('style'))
                                <span class="help-block" style="position: absolute; left: 150px; color: red; font-size:14px">
								<strong>{{ $errors->first('style') }}</strong>
							</span> @endif
                            <div class="col-sm-10">
                                <input id="inputHorizontalSuccess" name="style" type="text" maxlength="15" placeholder="15 characters maximum" class="form-control form-control-success" value="{{$product->style}}" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Size Type<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-4">
                                <select name="sizeType" class="form-control form-control-warning" id="sizeType">
                                    <option value="">Select Size Type</option>
                                    @foreach($sizeTypes as $size)
                                        <option value="{{$size->sizeType}}">{{$size->sizeType}}</option>
                                    @endforeach
                                </select>
                            </div>
                        {{--</div>--}}


                        {{--<div class="form-group row">--}}
                            <label style="text-align: right" class="col-sm-2 form-control-label">Size<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-4">
                                <select name="size" id="size" class="form-control form-control-warning" required>
                                    <option value="{{$product->size}}">{{$product->size}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Run to Size<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-4">
                                <select name="runToSize" class="form-control form-control-warning" required>
                                    <option value="">Select Run to Size</option>
                                    @foreach($runToSizes as $value)
                                        <option value="{{$value->runToSizeName}}"
                                                @if($product->runtosize==$value->runToSizeName)
                                                selected
                                                @endif
                                        >{{$value->runToSizeName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            <label style="text-align: right" class="col-sm-2 form-control-label">Care<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-4">
                                <select name="care" class="form-control form-control-warning" required>
                                    <option value="">Select Care</option>
                                    @foreach($cares as $care)
                                        <option value="{{$care->careName}}"
                                                @if($product->care==$care->careName)
                                                selected
                                                @endif
                                        >{{$care->careName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">EAN<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <input id="inputHorizontalSuccess" name="ean" maxlength="13" placeholder="13 characters maximum" type="text" value="{{$product->ean}}" placeholder="ean" class="form-control form-control-success" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Price(£)<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <input id="inputHorizontalSuccess"  name="price" type="number" value="{{$product->price}}" placeholder="price" class="form-control form-control-success" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Stock Qty<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <input id="inputHorizontalSuccess"  name="stockQty" type="number" value="{{$product->stockQty}}" placeholder="quantity" class="form-control form-control-success" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Min Qty Alert<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <input id="inputHorizontalSuccess"  name="minQtyAlert" type="number" value="{{$product->minQtyAlert}}" placeholder="alert quantity" class="form-control form-control-success" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Product Description<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" id="comment"  name="description" required>{{$product->productDesc}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Status<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <select name="status" class="form-control form-control-warning" required>
                                    <?php for ($i=0;$i<count(Status);$i++){ if (Status[$i] != Status[2]){?>
                                    <option @if($product->status == Status[$i]) selected @endif value="<?php echo Status[$i]?>"><?php echo Status[$i]?></option>
                                    <?php }}?>

                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label"><b>Swatch</b></label>
                            <div class="col-sm-10">
                                <input type="file" name="swatchPic"  value="upload Image" accept=".jpg,.jpeg" id="swatchPic">
                                <img @if($product->swatchImage)
                                        src="{{url('productImage/'.$product->swatchImage)}}"
                                     @endif
                                     height="50px" width="50px" id="imgSwatchPic">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label"><b>Outfit</b> </label>
                            <div class="col-sm-10">
                                <input type="file" name="outfitPic"  value="upload Image" accept=".jpg,.jpeg" id="outfitPic">
                                <img
                                        @if($product->outfit)
                                        src="{{url('productImage/'.$product->outfit)}}"
                                        @endif
                                        height="50px" width="50px" id="imgOutfitPic">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label"><b>Main Image</b> </label>
                            <div class="col-sm-10">
                                <input type="file" name="mainPic"  value="upload Image" accept=".jpg,.jpeg" id="mainPic">
                                <img   @if($product->mainImage)
                                        src="{{url('productImage/'.$product->mainImage)}}"
                                       @endif
                                       height="50px" width="50px" id="imgMainPic">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label"><b>Image 2</b> </label>
                            <div class="col-sm-10">
                                <input type="file" name="image2Pic" value="image2Pic" accept=".jpg,.jpeg" id="image2Pic">
                                <img  @if($product->image2)
                                        src="{{url('productImage/'.$product->image2)}}"
                                      @endif
                                      height="50px" width="50px" id="imgImage2Pic">
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label"><b>Image 3</b> </label>
                            <div class="col-sm-10">
                                <input type="file" name="image3Pic" value="image3Pic" accept=".jpg,.jpeg" id="image3Pic">
                                <img height="50px" width="50px" id="imgImage3Pic"
                                     @if($product->image3)
                                     src="{{url('productImage/'.$product->image3)}}"
                                        @endif
                                >
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label"><b>Image 4</b> </label>
                            <div class="col-sm-10">
                                <input type="file" name="image4Pic" value="image4Pic" accept=".jpg,.jpeg" id="image4Pic">
                                <img height="50px" width="50px" id="imgImage4Pic"
                                     @if($product->image3)
                                     src="{{url('productImage/'.$product->image4)}}"
                                        @endif
                                >
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