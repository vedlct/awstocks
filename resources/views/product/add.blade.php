@extends('main')
@section('header')

    <link href="{{url('css/select2.min.css')}}" rel="stylesheet" />
@endsection
@section('content')

<div class="row">
   

   
    <div class="col-lg-12">
        <div class="card" style="margin-left: 10px; border-radius: 10px;">

            <div class="card-body" style="padding: 1%;">
                <div align="center" style="margin-bottom: 3%;">
                    <h2 style="color: #989898;"><b>Add Product Information</b></h2>
                </div>

                <form name="addProductForm" class="form-horizontal" method="post" action="{{route('product.insert')}}" onsubmit="return checkProduct()" enctype="multipart/form-data">
                    <div class="form-group row">
                        {{csrf_field()}}
                        <label class="col-sm-2 form-control-label">Product category<span style="color: red" class="required">*</span></label>
                        <div class="col-sm-10">
                            <select name="category" id="select" class="select form-control form-control-warning"   required>
							
                                <option value="">Select Prduct Category</option>
                                @foreach($categories as $category)
                                <option @if(old('category')==$category->categoryId )selected @endif value="{{$category->categoryId}}">{{$category->categoryName}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Brand Name<span style="color: red" class="required">*</span></label>
                        <div class="col-sm-10">
                            <input id="inputHorizontalWarning" type="text" value="{{ old('brand') }}" name="brand" maxlength="45" placeholder="45 characters maximum" class="form-control form-control-warning" required>
                            @if ($errors->has('brand'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('brand') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">sku<span style="color: red" class="required">*</span></label>
                        <div class="col-sm-10">
                            <input id="sku" type="text" value="{{ old('sku') }}" name="sku" maxlength="20" placeholder="20 characters maximum"  class="form-control form-control-warning" required>

                            @if ($errors->has('sku'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('sku') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Color<span style="color: red" class="required">*</span></label>
                        <div class="col-sm-10">
                            <select name="color" class="form-control form-control-warning" required>
                                <option value="">Select Color</option>
                                @foreach($sColors as $color)
                                <option @if(old('color')==$color->colorName )selected @endif value="{{$color->colorName}}">{{$color->colorName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Color Description<span style="color: red" class="required">*</span></label>
                        <div class="col-sm-10">
                            <input id="inputHorizontalWarning" type="text" maxlength="20" placeholder="20 characters maximum"value="{{ old('colorDesc') }}" name="colorDesc"  class="form-control form-control-warning" required>
                            @if ($errors->has('colorDesc'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('colorDesc') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>



                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Product Name<span style="color: red" class="required">*</span></label>
                        <div class="col-sm-10">
                            <input  maxlength="70" placeholder="70 characters maximum" id="inputHorizontalSuccess" type="text" value="{{ old('productName') }}" name="productName"  class="form-control form-control-success" required>
							
							@if ($errors->has('productName'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('productName') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Style<span style="color: red" class="required">*</span></label>
                        <div class="col-sm-10">
                            <input id="style" value="{{ old('style') }}" name="style"  maxlength="15" placeholder="15 characters maximum"type="text"  class="form-control form-control-success" required>

							@if ($errors->has('style'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('style') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>



                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Size Type<span style="color: red" class="required">*</span></label>
                        <div class="col-sm-4">
                            <select name="sizeType" class="form-control form-control-warning" id="sizeType"  required >
                                <option value="">Select Size Type</option>
                                @foreach($sizeTypes as $size)
                                    <option @if(old('sizeType')==$size->sizeType )selected @endif value="{{$size->sizeType}}">{{$size->sizeType}}</option>
                                @endforeach
                            </select>
                        </div>
                    {{--</div>--}}

                    {{--<div class="form-group row">--}}
                        <label style="text-align: right"class="col-sm-2 form-control-label">Size<span style="color: red" class="required">*</span></label>
                        <div class="col-sm-4">
                            <select name="size" id="size" class="form-control form-control-warning" required>
                                <option value="">Select Size</option>
                                @if (old('size'))

                                    <option selected value="{{old('size')}}">{{old('size')}}</option>

                                @endif
                            </select>
                        </div>
                    </div>




                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Run to Size<span style="color: red" class="required">*</span></label>
                        <div class="col-sm-4">
                            <select name="runToSize" class="form-control form-control-warning" required>
                                <option value="">Select Run to Size</option>
                                @foreach($runToSizes as $value)
                                    <option @if(old('runToSize')==$value->runToSizeName )selected @endif value="{{$value->runToSizeName}}">{{$value->runToSizeName}}</option>
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
                                    <option @if(old('care')==$care->careName )selected @endif value="{{$care->careName}}">{{$care->careName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">EAN<span style="color: red" class="required">*</span></label>
                        <div class="col-sm-10">
                            <input id="inputHorizontalSuccess" value="{{ old('ean') }}" name="ean"  maxlength="13" placeholder="13 characters maximum"type="text"  class="form-control form-control-success" required>

							@if ($errors->has('ean'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('ean') }}</strong>
                                    </span>
                            @endif
							
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Price(£)<span style="color: red" class="required">*</span></label>
                        <div class="col-sm-10">

                            <input id="inputHorizontalSuccess" value="{{ old('price') }}" name="price" type="number" min="0" class="form-control form-control-success myInputField" required>
							@if ($errors->has('price'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Stock Qty<span style="color: red" class="required">*</span></label>
                        <div class="col-sm-10">
						
                            <input id="inputHorizontalSuccess" value="{{ old('stockQty') }}" name="stockQty" type="number"  class="form-control form-control-success" required>

							@if ($errors->has('stockQty'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('stockQty') }}</strong>
                                    </span>
                            @endif
							
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Min Qty Alert<span style="color: red" class="required">*</span></label>
                        <div class="col-sm-10">
						
                            <input id="inputHorizontalSuccess" value="{{ old('minQtyAlert') }}" name="minQtyAlert" type="number"  class="form-control form-control-success" required>

							@if ($errors->has('minQtyAlert'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('minQtyAlert') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Product Description<span style="color: red" class="required">*</span></label>
                        <div class="col-sm-10">
						
                            <textarea class="form-control" rows="5" id="comment"  name="description" required> {{ old('description') }}</textarea>

							@if ($errors->has('description'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                            @endif
							
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Status<span style="color: red" class="required">*</span></label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control form-control-warning" required>
                                <option selected value="">Select Status</option>
                                <?php for ($i=0;$i<count(Status);$i++){ if (Status[$i] == Status[0]){?>
                                <option selected value="<?php echo Status[$i]?>"><?php echo Status[$i]?></option>
                                <?php }}?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label"><b>Swatch</b><span style="color: red" class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="file" name="swatchPic"  value="upload Image" accept=".jpg, .jpeg" id="swatchPic" required>
                            @if ($errors->has('swatchPic'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('swatchPic') }}</strong>
                                    </span>
                            @endif
                            <img height="50px" width="50px" id="imgSwatchPic">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label"><b>Outfit</b><span style="color: red" class="required">*</span> </label>
                        <div class="col-sm-10">
                            <input type="file" name="outfitPic"  value="upload Image"  accept=".jpg, .jpeg" id="outfitPic" required>
                            @if ($errors->has('outfitPic'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('outfitPic') }}</strong>
                                    </span>
                            @endif
                            <img height="50px" width="50px" id="imgOutfitPic">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label"><b>Main Image</b> <span style="color: red" class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="file" name="mainPic"  value="upload Image"  accept=".jpg,.jpeg" id="mainPic" required>
                            @if ($errors->has('mainPic'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('mainPic') }}</strong>
                                    </span>
                            @endif
                            <img height="50px" width="50px" id="imgMainPic">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label"><b>Image 2</b> <span style="color: red" class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="file" name="image2Pic" value="image2Pic" accept=".jpg, .jpeg" id="image2Pic" required>
                            @if ($errors->has('image2Pic'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('image2Pic') }}</strong>
                                    </span>
                            @endif
                            <img height="50px" width="50px" id="imgImage2Pic">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label"><b>Image 3</b> <span style="color: red" class="required">*</span></label>
                        <div class="col-sm-10">

						<input type="file" name="image3Pic" value="image3Pic"  accept=".jpg, .jpeg" id="image3Pic" required>
                            @if ($errors->has('image3Pic'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('image3Pic') }}</strong>
                                    </span>
                            @endif
                            <img height="50px" width="50px" id="imgImage3Pic">
                        </div>
                    </div>



                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label"><b>Image 4</b> <span style="color: red" class="required">*</span></label>
                        <div class="col-sm-10">
						
                            <input type="file" name="image4Pic" value="image4Pic"  accept=".jpg,.jpeg" id="image4Pic" required>
                            @if ($errors->has('image4Pic'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('image4Pic') }}</strong>
                                    </span>
                            @endif

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
    <script src="{{url('js/select2.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script>
        $(document).ready(function() {
            $('.select').select2();
        });

        {{--function checkspecialChar() {--}}

            {{--var iChars = "!@#$%^&*()+=-[]\\\';,./{}|\":<>?";--}}

//            for (var i = 0; i < document.addProductForm.style.value.length; i++) {
//                if (iChars.indexOf(document.addProductForm.style.value.charAt(i)) != -1) {
//                    alert ("Your username has special characters. \nThese are not allowed.\n Please remove them and try again.");
//                    return false;
//                }
//            }

        {{--}--}}

        function checkProduct() {

                    var iChars = "!@#$%^&*()+= []\\\';,./{}|\":<>?";

                    for (var i = 0; i < document.addProductForm.style.value.length; i++) {
                        if (iChars.indexOf(document.addProductForm.style.value.charAt(i)) != -1) {
                            alert ("Your can not use not use any special character in Style Filed");
                            return false;
                        }
                    }
                    for (var i = 0; i < document.addProductForm.sku.value.length; i++) {
                        if (iChars.indexOf(document.addProductForm.sku.value.charAt(i)) != -1) {
                            alert ("Your can not use not use any special character in sku Filed");
                            return false;
                        }
                    }

                }

        function setTwoNumberDecimal(event) {
            alert(asd);
            this.value = parseFloat(this.value).toFixed(2);
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

        function doneTyping () {
            var vale = $('.myInputField').val();
            var regexTest = /^\d+(?:\.\d\d?)?$/;
            var ok = regexTest.test(vale);
            if(!ok){
                alert('please enter only two decimal number');
                $('.myInputField').val('');
            }
        }

    </script>

@endsection