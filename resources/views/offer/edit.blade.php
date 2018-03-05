@extends('main')

@section('content')

    <div class="row">


        <div class="col-lg-12">
            <div class="card" style="margin-left: 10px; border-radius: 10px;">

                <div class="card-body" style="padding: 1%;">
                    <div align="center" style="margin-bottom: 3%;">
                        <h2 style="color: #989898;"><b>Edit Product Information</b></h2>
                    </div>
                    <form method="post" action="{{route('offer.update')}}">

                        <div class="form-group row">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$id}}">
                            <label class="col-sm-2 form-control-label">Product category</label>
                            <div class="col-sm-10">
                                <select name="category" class="form-control form-control-warning" id="category" >
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
                                    <option value="{{$offer->fkproductId}}">{{$offer->product->productName}}</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Discount Price</label>
                            <div class="col-sm-10">
                                <input id="inputHorizontalWarning" type="number"  name="disPrice" value="{{$offer->disPrice}}" placeholder="price" onchange="setTwoNumberDecimal"   step="0.01" class="form-control form-control-warning" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Product Id Type</label>
                            <div class="col-sm-10">
                                <input id="inputHorizontalWarning" type="text" name="productIdType" value="<?php echo $offer['product-id-type']; ?>" placeholder="insert Id" class="form-control form-control-warning" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Start Date</label>
                            <div class="col-sm-10">
                                <input id="fromdate" type="text"  name="disStartPrice" value="{{$offer->disStartPrice}}" placeholder="pick date" class="form-control form-control-warning" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">End Date</label>
                            <div class="col-sm-10">
                                <input id="todate" type="text"  name="disEndPrice" placeholder="pick date" value="{{$offer->disEndPrice}}" class="form-control form-control-warning" required>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">State</label>
                            <div class="col-sm-10">
                                <select name="state" class="form-control form-control-warning" required>
                                    @foreach(STATE as $s)
                                        <option value="{{$s}}"
                                        @if($offer->state == $s)
                                            selected
                                                @endif
                                        >{{$s}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Status</label>
                            <div class="col-sm-10">
                                <select name="status" class="form-control form-control-warning" required>
                                    <option value="Active">Active</option>
                                    <option value="Inactive"  @if($offer->status=="Inactive")
                                    selected
                                            @endif>Inactive</option>
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