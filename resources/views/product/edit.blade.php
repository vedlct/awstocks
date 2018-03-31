@extends('main')
@section('header')

    <link href="{{url('css/select2.min.css')}}" rel="stylesheet" />
    <style>

        table{font-size: 15px}
        .container-fluid  {padding: 15px  5px;}
    </style>
@endsection
@section('content')

    <div class="row">


        <div class="col-lg-12">
            <div class="card" style="margin-left: 10px; border-radius: 10px;">

                <div class="card-body" style="padding: 1%;">
                    <div align="center" style="margin-bottom: 3%;">
                        <h2 style="color: #989898;"><b>Edit Product Information</b></h2>
                    </div>

                    <form id="editProduct" name="editProduct" class="form-horizontal" method="post" action="{{route('product.update')}}" onsubmit="return checkProduct()" enctype="multipart/form-data">
                        <div class="form-group row">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$id}}">
                            <label class="col-sm-2 form-control-label">Product category<span style="color: red" class="required">*</span></label>

                            <div class="col-sm-10">
                                <select name="category" class=" select form-control form-control-warning" required>
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
                            <label class="col-sm-2 form-control-label">Product Name<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <input id="inputHorizontalSuccess" type="text"  name="productName" placeholder="name"  placeholder="100 characters maximum" class="form-control form-control-success" value="{{$product->productName}}" >
                                @if ($errors->has('productName'))
                                    <span class="help-block" style="position: absolute; left: 150px; color: red; font-size:14px">
								<strong>{{ $errors->first('productName') }}</strong>
							</span> @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Brand Name<span style="color: red" class="required">*</span></label>

                            <div class="col-sm-10">
                                <input id="inputHorizontalWarning" type="text"  name="brand" placeholder="brand"  placeholder="100 characters maximum" class="form-control form-control-warning" value="{{$product->brand}}" required>
                                @if ($errors->has('brand'))
                                    <span class="help-block" style="position: absolute; left: 150px; color: red; font-size:14px">
								<strong>{{ $errors->first('brand') }}</strong>
							</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">SKU<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <input id="inputHorizontalWarning" type="text" name="sku"  placeholder="20 characters maximum" class="form-control form-control-warning" value="{{$product->sku}}" required>
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
                                        <option value="{{$color->colorName}}"
                                                @if($color->colorName == $product->color)
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
                                <input id="inputHorizontalWarning" type="text"  name="colorDesc" value="{{$product->colorDesc}}" placeholder="255 characters maximum" class="form-control form-control-warning" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Style<span style="color: red" class="required">*</span></label>
                            @if ($errors->has('style'))
                                <span class="help-block" style="position: absolute; left: 150px; color: red; font-size:14px">
								<strong>{{ $errors->first('style') }}</strong>
							</span> @endif
                            <div class="col-sm-10">
                                <input id="inputHorizontalSuccess" name="style" type="text"  placeholder="255 characters maximum" class="form-control form-control-success" value="{{$product->style}}" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Size Type</label>
                            <div class="col-sm-4">

                                <select name="sizeType" class="form-control form-control-warning" id="sizeType">
                                    <option value="">Select Size Type</option>
                                    @foreach($sizeTypes as $size)
                                        <option  value="{{$size->sizeType}}">{{$size->sizeType}}</option>
                                    @endforeach
                                </select>
                            </div>
                        {{--</div>--}}


                        {{--<div class="form-group row">--}}
                            <label style="text-align: right" class="col-sm-2 form-control-label">Size</label>
                            <div class="col-sm-4">
                                <select name="size" id="size" class="form-control form-control-warning">
                                    <option value="{{$product->size}}">{{$product->size}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Run to Size</label>
                            <div class="col-sm-4">
                                <select name="runToSize" class="form-control form-control-warning">
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
                            <label style="text-align: right" class="col-sm-2 form-control-label">Care</label>
                            <div class="col-sm-4">
                                <select name="care" class="form-control form-control-warning">
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
                            <label class="col-sm-2 form-control-label">Size Description</label>
                            <div class="col-sm-10">
                                <input id="inputHorizontalSuccess" value="{{$product->sizeDescription }}" name="sizeDescription"  type="text"  class="form-control form-control-success">
                                @if ($errors->has('sizeDescription'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sizeDescription') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Product Location</label>
                            <div class="col-sm-10">
                                <input id="inputHorizontalSuccess" value="{{$product->location}}" name="location"  type="text"  class="form-control form-control-success">
                                @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>




                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">EAN</label>
                            <div class="col-sm-10">
                                <input id="inputHorizontalSuccess" name="ean"  placeholder="100 characters maximum" type="text" value="{{$product->ean}}" class="form-control form-control-success">
                            </div>
                        </div>




                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Cost price(£)</label>
                            <div class="col-sm-10">

                                <input id="inputHorizontalSuccess" value="{{ $product->costPrice }}" name="costPrice" placeholder="optional"  type="text" min="0" class="form-control form-control-success cost">
                                @if ($errors->has('costPrice'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('costPrice') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>




                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Whole sale price(£)</label>
                            <div class="col-sm-10">

                                <input id="inputHorizontalSuccess" value="{{ $product->wholePrice }}" name="wholePrice" placeholder="optional" type="text" min="0" class="form-control form-control-success whole">
                                @if ($errors->has('wholePrice'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('wholePrice') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">RRP(£)<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <input id="inputHorizontalSuccess"  name="price" type="text" value="{{$product->price}}" placeholder="price" class="form-control form-control-success myInputField" required>
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
                                    <?php for ($i=0;$i<count(Status);$i++){?>
                                    <option @if($product->status == Status[$i]) selected @endif value="<?php echo Status[$i]?>"><?php echo Status[$i]?></option>
                                    <?php }?>

                                </select>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label"><b>Main Image</b><span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="file" name="mainPic"  value="upload Image" accept=".jpg,.jpeg" id="mainPic" >
                                @if ($errors->has('mainPic'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mainPic') }}</strong>
                                    </span>
                                @endif
                                <img   @if($product->mainImage)
                                       src="{{url('public/productImage/thumb')."/".basename($product->mainImage)}}"
                                       @endif
                                       height="50px" width="50px" id="imgMainPic">
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label"><b>Swatch</b></label>
                            <div class="col-sm-10">
                                <input type="file" name="swatchPic"  value="upload Image" accept=".jpg,.jpeg" id="swatchPic">
                                @if ($errors->has('swatchPic'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('swatchPic') }}</strong>
                                    </span>
                                @endif
                                <img @if($product->swatchImage)
                                        src="{{url('public/productImage/thumb')."/".basename($product->swatchImage)}}"
                                     @endif
                                     height="50px" width="50px" id="imgSwatchPic">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label"><b>Outfit</b> </label>
                            <div class="col-sm-10">
                                <input type="file" name="outfitPic"  value="upload Image" accept=".jpg,.jpeg" id="outfitPic">
                                @if ($errors->has('outfitPic'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('outfitPic') }}</strong>
                                    </span>
                                @endif
                                <img
                                        @if($product->outfit)
                                        src="{{url('public/productImage/thumb')."/".basename($product->outfit)}}"
                                        @endif
                                        height="50px" width="50px" id="imgOutfitPic">
                            </div>
                        </div>





                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label"><b>Image 2</b> </label>
                            <div class="col-sm-10">
                                <input type="file" name="image2Pic" value="image2Pic" accept=".jpg,.jpeg" id="image2Pic">
                                @if ($errors->has('image2Pic'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image2Pic') }}</strong>
                                    </span>
                                @endif
                                <img  @if($product->image2)
                                        src="{{url('public/productImage/thumb')."/".basename($product->image2)}}"
                                      @endif
                                      height="50px" width="50px" id="imgImage2Pic">
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label"><b>Image 3</b> </label>
                            <div class="col-sm-10">
                                <input type="file" name="image3Pic" value="image3Pic" accept=".jpg,.jpeg" id="image3Pic">
                                @if ($errors->has('image3Pic'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image3Pic') }}</strong>
                                    </span>
                                @endif
                                <img height="50px" width="50px" id="imgImage3Pic"
                                     @if($product->image3)
                                     src="{{url('public/productImage/thumb')."/".basename($product->image3)}}"
                                        @endif
                                >
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label"><b>Image 4</b> </label>
                            <div class="col-sm-10">
                                <input type="file" name="image4Pic" value="image4Pic" accept=".jpg,.jpeg" id="image4Pic">
                                @if ($errors->has('image4Pic'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image4Pic') }}</strong>
                                    </span>
                                @endif
                                <img height="50px" width="50px" id="imgImage4Pic"
                                     @if($product->image4)
                                     src="{{url('public/productImage/thumb')."/".basename($product->image4)}}"
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
    <script src="{{url('js/select2.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <script>
        $(document).ready(function() {
            $('.select').select2();
        });

        function checkProduct() {

            var iChars = "!@#$%^&*()+=[]\\\';,./{}|\":<>?";

            for (var i = 0; i < document.editProduct.style.value.length; i++) {
                if (iChars.indexOf(document.addProductForm.style.value.charAt(i)) != -1) {
                    alert ("Your can not use not use any special character in Style Filed");
                    return false;
                }
            }
            for (var i = 0; i < document.editProduct.sku.value.length; i++) {
                if (iChars.indexOf(document.addProductForm.sku.value.charAt(i)) != -1) {
                    alert ("Your can not use not use any special character in sku Filed");
                    return false;
                }
            }

        }


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


    var typingTimer;
    var doneTypingInterval = 1000;

    $('.myInputField').keyup(function(){
        clearTimeout(typingTimer);
        if ($('.myInputField').val) {
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        }
    });
        $('.cost').keyup(function(){
            clearTimeout(typingTimer);
            if ($('.cost').val) {
                typingTimer = setTimeout(cost, doneTypingInterval);
            }
        });

        $('.whole').keyup(function(){
            clearTimeout(typingTimer);
            if ($('.whole').val) {
                typingTimer = setTimeout(whole, doneTypingInterval);
            }
        });

    function doneTyping () {
        var vale = $('.myInputField').val();
        var regexTest = /^\d+(?:\.\d\d?)?$/;
        var ok = regexTest.test(vale);
        if(!ok){
            alert('please enter only two decimal number');
            $('.myInputField').val('');
        }
    }

        function whole () {
            var vale = $('.whole').val();
            var regexTest = /^\d+(?:\.\d\d?)?$/;
            var ok = regexTest.test(vale);
            if(!ok){
                alert('please enter only two decimal number');
                $('.whole').val('');
            }
        }

        function cost () {
            var vale = $('.cost').val();
            var regexTest = /^\d+(?:\.\d\d?)?$/;
            var ok = regexTest.test(vale);
            if(!ok){
                alert('please enter only two decimal number');
                $('.cost').val('');
            }
        }

</script>

    @endsection