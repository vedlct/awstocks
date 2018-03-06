@extends('main')

@section('content')

    <div class="row">


        <div class="col-lg-12">
            <div class="card" style="margin-left: 10px; border-radius: 10px;">

                <div class="card-body" style="padding: 1%;">
                    <div align="center" style="margin-bottom: 3%;">
                        <h2 style="color: #989898;"><b>Add Offer Information</b></h2>
                    </div>
                    <form method="post" action="{{route('offer.insert')}}" onsubmit="return checkOfferInsert()">

                        <div class="form-group row">
                            {{csrf_field()}}
                            <label class="col-sm-2 form-control-label">Product category<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <select name="category" class="form-control form-control-warning" id="category" required>
                                    <option value="">Select One</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->categoryId}}">{{$category->categoryName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="form-group row">

                            <label class="col-sm-2 form-control-label">Product Name<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <select name="product" class="form-control form-control-warning" id="product" required>
                                    <option value="">Select Product</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">

                            <label  class="col-sm-2 form-control-label" >Discount Price<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-4">
                                <input  id="inputHorizontalWarning" type="number" value="{{ old('disPrice') }}" name="disPrice"  class="form-control form-control-warning myInputField" required>
                            </div>

                            <label  class="col-sm-1 form-control-label" >Price:</label>
                            <div class="col-sm-5">
                                <input  id="price" type="text"    class="form-control form-control-warning producprice" readonly>
                            </div>


                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Product Id Type<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                {{--<input id="inputHorizontalWarning" type="text" value="{{ old('productIdType') }}" name="productIdType" placeholder="insert Id" class="form-control form-control-warning" required>--}}
                                <select name="productIdType" class="form-control form-control-warning" required>
                                    <option selected value="">Select Product Id Type</option>
                                    <?php for ($i=0;$i<count(ProductIdType);$i++){?>
                                    <option @if(ProductIdType[$i] == old('productIdType')) selected @endif value="<?php echo ProductIdType[$i]?>"><?php echo ProductIdType[$i]?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Start Date<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-4">
                                <input id="fromdate" type="text" value="{{ old('disStartPrice') }}" name="disStartPrice"  placeholder="pick date" class="form-control form-control-warning" required>
                            </div>
                            <label class="col-sm-1 form-control-label">End Date<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-5">
                                <input id="todate" type="text" value="{{ old('disEndPrice') }}" name="disEndPrice" placeholder="pick date" class="form-control form-control-warning" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">State<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <select name="state" class="form-control form-control-warning" required>
                                    <option selected value="">Select State</option>
                                    @foreach(STATE as $s)
                                        <option value="{{$s}}">{{$s}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Status<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <select name="status" class="form-control form-control-warning" required>
                                    <option selected value="">Select Status</option>
                                    <?php for ($i=0;$i<count(Status);$i++){ if (Status[$i] != Status[2]){?>
                                    <option value="<?php echo Status[$i]?>"><?php echo Status[$i]?></option>
                                    <?php }}?>
                                </select>
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

        function checkOfferInsert() {

        var fromdate =  document.getElementById("fromdate").value;
        var todate =   document.getElementById("todate").value;
//        alert(fromdate);
//        alert(todate);

        if (fromdate > todate) {
            alert ("Event End Date Can not be before Event Start Date!!");
            return false;
        }

        }


        $("#category").change(function() {

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var type=$(this).val();

            $.ajax({
                type : 'post' ,
                url : '{{route('getProductByCategory')}}',
                data : {_token: CSRF_TOKEN,'category':type} ,
                success : function(data){
//                    console.log(data);
                    document.getElementById("product").innerHTML = data;
                    document.getElementById("price").value = '';


                }
            });
        });

        $("#product").change(function() {
            var type=$(this).val();

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type : 'post' ,
                url : '{{route('getProductPrice')}}',
                data : {_token: CSRF_TOKEN,'id':type} ,
                success : function(data){
//                    console.log(data);
                    if(data !=null){
                        document.getElementById("price").value = data.price;
                    }
                    else {
                        document.getElementById("price").value = '';

                    }

                }
            });


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
            var price = $('.producprice').val();
            var regexTest = /^\d+(?:\.\d\d?)?$/;
            var ok = regexTest.test(vale);
            if(!ok){
                alert('please enter only two decimal number');
                $('.myInputField').val('');
            }
            if (vale >= price){
                alert('discount price cannot be more than product price');
                $('.myInputField').val('');
            }
        }


        function setTwoNumberDecimal(event) {
            this.value = parseFloat(this.value).toFixed(2);
        }

        $( function() {
            $( "#fromdate" ).datepicker();
            $( "#todate" ).datepicker();
        } );

    </script>

@endsection