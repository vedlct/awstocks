@extends('main')

@section('content')

    <div class="row">





        <div class="col-lg-12">
            <div class="card" style="margin-left: 10px; border-radius: 10px;">

                <div class="card-body" style="padding: 1%;">
                    <div align="center" style="margin-bottom: 3%;">
                        <h2 style="color: #989898;"><b>Add Product Information</b></h2>
                    </div>

                    <form class="form-horizontal" method="post" action="{{route('product.update')}}" enctype="multipart/form-data">
                        <div class="form-group row">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$id}}">
                            <label class="col-sm-2 form-control-label">Product category</label>

                            <div class="col-sm-10">
                                <select name="category" class="form-control form-control-warning" required>
                                    <option value="">Select One</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->categoryId}}"
                                                    @if($category->categoryId == $product->fkcategoryId)
                                                    selected
                                                    @endif
                                            >{{$category->name}}</option>

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
                            <label class="col-sm-2 form-control-label">Brand Name</label>

                            <div class="col-sm-10">
                                <input id="inputHorizontalWarning" type="text" name="brand" placeholder="brand" class="form-control form-control-warning" value="{{$product->brand}}" required>
                                @if ($errors->has('brand'))
                                    <span class="help-block" style="position: absolute; left: 150px; color: red; font-size:14px">
								<strong>{{ $errors->first('brand') }}</strong>
							</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">sku</label>
                            <div class="col-sm-10">
                                <input id="inputHorizontalWarning" type="text" name="sku" placeholder="SKU" class="form-control form-control-warning" value="{{$product->sku}}" required>
                                @if ($errors->has('category'))
                                    <span class="help-block" style="position: absolute; left: 150px; color: red; font-size:14px">
								<strong>{{ $errors->first('category') }}</strong>
							</span> @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Standard Color</label>
                            <div class="col-sm-10">
                                <select name="standardColor" class="form-control form-control-warning" required>
                                    <option value="">Select One</option>
                                    @foreach($sColors as $color)
                                        <option value="{{$color->colorId}}"
                                                @if($color->colorId == $product->fkscolorId)
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
                            <label class="col-sm-2 form-control-label">Status</label>
                            <div class="col-sm-10">
                                <select name="status" class="form-control form-control-warning" required>
                                    <option value="1">Active</option>
                                    <option value="0"  @if($product->status==0)
                                                    selected
                                            @endif>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Product Name</label>
                            <div class="col-sm-10">
                                <input id="inputHorizontalSuccess" type="text" name="productName" placeholder="name" class="form-control form-control-success" value="{{$product->productName}}" required>
                                @if ($errors->has('productName'))
                                    <span class="help-block" style="position: absolute; left: 150px; color: red; font-size:14px">
								<strong>{{ $errors->first('productName') }}</strong>
							</span> @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Style</label>
                            @if ($errors->has('style'))
                                <span class="help-block" style="position: absolute; left: 150px; color: red; font-size:14px">
								<strong>{{ $errors->first('style') }}</strong>
							</span> @endif
                            <div class="col-sm-10">
                                <input id="inputHorizontalSuccess" name="style" type="text" placeholder="style" class="form-control form-control-success" value="{{$product->brand}}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Size</label>
                            <div class="col-sm-10">

                                <select name="size" class="form-control form-control-warning" required>
                                    <option value="">Select One</option>
                                    @foreach(SIZE as $item)
                                        <option value="{{$item}}"
                                                @if($product->size==$item)
                                                selected
                                                @endif
                                        >{{$item}}</option>
                                    @endforeach

                                </select>
                                @if ($errors->has('size'))
                                    <span class="help-block" style="position: absolute; left: 150px; color: red; font-size:14px">
								<strong>{{ $errors->first('size') }}</strong>
							</span> @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Detailed Color</label>
                            <div class="col-sm-10">
                                <select name="detailedColor" class="form-control form-control-warning" required>
                                    <option value="">Select One</option>
                                    @foreach($dColors as $color)
                                        <option value="{{$color->colorId}}"
                                                @if($color->colorId == $product->fkdcolorId)
                                                selected
                                                @endif
                                        >{{$color->colorName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Product Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" id="comment" name="description" required>{{$product->productDecription}}</textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label"><b>Swatch</b></label>
                            <div class="col-sm-10">
                                <input type="file" name="swatchPic"  value="upload Image" accept="image/*" id="swatchPic">
                                <img @if($product->swatch)
                                        src="{{url('productImage/'.$product->swatch)}}"
                                     @endif
                                     height="50px" width="50px" id="imgSwatchPic">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label"><b>Outfit</b> </label>
                            <div class="col-sm-10">
                                <input type="file" name="outfitPic"  value="upload Image" accept="image/*" id="outfitPic">
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
                                <input type="file" name="mainPic"  value="upload Image" accept="image/*" id="mainPic">
                                <img   @if($product->mainImage)
                                        src="{{url('productImage/'.$product->mainImage)}}"
                                       @endif
                                       height="50px" width="50px" id="imgMainPic">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label"><b>Image 2</b> </label>
                            <div class="col-sm-10">
                                <input type="file" name="image2Pic" value="image2Pic" accept="image/*" id="image2Pic">
                                <img  @if($product->image2)
                                        src="{{url('productImage/'.$product->image2)}}"
                                      @endif
                                      height="50px" width="50px" id="imgImage2Pic">
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

<script>

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

</script>

    @endsection