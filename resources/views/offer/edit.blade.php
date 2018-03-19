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

                        <h2 style="color: #989898;"><b>Edit Offer Info</b></h2>

                    </div>
                    <form method="post" action="{{route('offer.update')}}" onsubmit="return checkOfferInsert()">

                        <div class="form-group row">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$id}}">
                            <label class="col-sm-2 form-control-label">Product category<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <select name="category" class="select form-control form-control-warning" id="category" >
                                    <option value="">Select One</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->categoryId}}"<?php if (!empty($offer->product->fkcategoryId) && $offer->product->fkcategoryId == $category->categoryId)  echo 'selected = "selected"'; ?>>{{$category->categoryName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="form-group row">

                            <label class="col-sm-2 form-control-label">Product Name<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <select name="product" class="form-control form-control-warning" id="product" required>
                                    <option value="{{$offer->fkproductId}}">{{$offer->product->productName}}</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Discount Price<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <input id="" type="number"  value="{{$offer->disPrice}}" placeholder="price"  step="0.01" class="form-control form-control-warning " readonly>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Discount <span style="color: red" class="required">%</span></label>
                            <div class="col-sm-10">
                                <input id="" type="number" value="" placeholder="" name="disPercent"  class="form-control form-control-warning" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label"> Price<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <input  id="price" type="number" name="price" class="form-control form-control-warning producprice" value="{{$offer->product->price}}" readonly>
                            </div>
                        </div>




                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Product Id Type<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <select name="productIdType" class="form-control form-control-warning" required>
                                    <option selected value="">Select Product Id Type</option>
                                    <?php for ($i=0;$i<count(ProductIdType);$i++){?>
                                    <option @if(ProductIdType[$i] == $offer['product-id-type']) selected @endif value="<?php echo ProductIdType[$i]?>"><?php echo ProductIdType[$i]?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Start Date<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <input id="fromdate" type="date"  name="disStartPrice" value="{{$offer->disStartPrice}}" placeholder="pick date" class="form-control form-control-warning" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">End Date<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <input id="todate" type="date"  name="disEndPrice" placeholder="pick date" value="{{$offer->disEndPrice}}" class="form-control form-control-warning" required>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">State<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <select name="state" class="form-control form-control-warning" required>
                                    <option selected value="">Select State</option>
                                    <?php for ($i=0;$i<count(STATE);$i++){?>
                                        <option @if($offer->state == STATE[$i]) selected @endif value="<?php echo STATE[$i]?>"><?php echo STATE[$i]?></option>
                                        <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Status<span style="color: red" class="required">*</span></label>
                            <div class="col-sm-10">
                                <select name="status" class="form-control form-control-warning" required>


                                        <option selected value="">Select Status</option>
                                        <?php for ($i=0;$i<count(Status);$i++){ if (Status[$i] != Status[1]){?>
                                        <option @if($offer->status==Status[$i]) selected @endif value="<?php echo Status[$i]?>"><?php echo Status[$i]?></option>
                                        <?php }} ?>

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
    <script src="{{url('js/select2.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <script>
        $(document).ready(function() {
            $('.select').select2();
        });

        function checkOfferInsert() {

            var fromdate =  document.getElementById("fromdate").value;
            var todate =   document.getElementById("todate").value;


            if (fromdate > todate) {
                alert ("End Date Can not be before Start Date!!");
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

                }
            });
        });


//        var typingTimer;
//        var doneTypingInterval = 1000;
//
//        $('.myInputField').keyup(function(){
//            clearTimeout(typingTimer);
//            if ($('.myInputField').val) {
//                typingTimer = setTimeout(doneTyping, doneTypingInterval);
//            }
//        });

//        function doneTyping () {
//            var vale = $('.myInputField').val();
//            var price = $('.producprice').val();
//            var regexTest = /^\d+(?:\.\d\d?)?$/;
//            var ok = regexTest.test(vale);
//            if(!ok){
//                alert('please enter only two decimal number');
//                $('.myInputField').val('');
//            }
//            if (vale >= price){
//                alert('discount price cannot be more than product price');
//                $('.myInputField').val('');
//            }
//        }

//
//        function setTwoNumberDecimal(event) {
//            this.value = parseFloat(this.value).toFixed(2);
//        }

        $( function() {
            $( "#fromdate" ).datepicker();
            $( "#todate" ).datepicker();
        } );

    </script>

@endsection