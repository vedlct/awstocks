@extends('main')

@section('content')

    <div class="row">


        <div class="col-lg-12">
            <div class="card" style="margin-left: 10px; border-radius: 10px;">

                <div class="card-body" style="padding: 1%;">
                    <div align="center" style="margin-bottom: 3%;">
                        <h2 style="color: #989898;"><b>Add Offer Information</b></h2>
                    </div>
                    <form method="post" action="{{route('offer.insert')}}">

                    <div class="form-group row">
                        {{csrf_field()}}
                        <label class="col-sm-2 form-control-label">Product category</label>
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

                        <label class="col-sm-2 form-control-label">Product Name</label>
                        <div class="col-sm-10">
                            <select name="product" class="form-control form-control-warning" id="product" required>
                                <option value="">Select Product</option>
                            </select>
                        </div>
                    </div>



					<div class="form-group row">
						<div class="form-group col-md-6">
							<label style="margin-left: -12px;" class="col-md-2" >Price</label>
							<input  id="price" type="text"  placeholder="price"  class="form-control form-control-warning col-md-10" readonly>
						</div>

						<div class="form-group col-md-6">
							<label  class="col-md-3" style="margin-left: -30px;">Discount Price</label>
							<input  id="inputHorizontalWarning" type="number" value="{{ old('disPrice') }}" name="disPrice" placeholder="price" onchange="setTwoNumberDecimal" min="0"  step="0.01" class="form-control form-control-warning col-md-9" required>
						</div>
					</div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">Product Id Type</label>
                        <div class="col-sm-10">
                            <input id="inputHorizontalWarning" type="text" value="{{ old('productIdType') }}" name="productIdType" placeholder="insert Id" class="form-control form-control-warning" required>
                        </div>
                    </div>

                    <div class="form-group row">

                            <label class="col-md-3 form-control-label">Start Date</label>

                                <input id="fromdate" type="text" value="{{ old('disStartPrice') }}" name="disStartPrice"  placeholder="pick date" class="form-control form-control-warning col-md-3" required>






                            <label class="col-md-3">End Date</label>

                                <input id="todate" type="text" value="{{ old('disEndPrice') }}" name="disEndPrice" placeholder="pick date" class="form-control form-control-warning col-md-3" required>



                    </div>



                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">State</label>
                            <div class="col-sm-10">
                                <select name="state" class="form-control form-control-warning" required>
                                    @foreach(STATE as $s)
                                    <option value="{{$s}}">{{$s}}</option>
                                    @endforeach
                                </select>
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
                        document.getElementById("price").value = data;
                    }
                    else {
                        document.getElementById("price").value = '';

                    }

                }
            });


        });


        function setTwoNumberDecimal(event) {
            this.value = parseFloat(this.value).toFixed(2);
        }

        $( function() {
            $( "#fromdate" ).datepicker();
            $( "#todate" ).datepicker();
        } );

    </script>

@endsection