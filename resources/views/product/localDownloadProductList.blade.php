
<table class="table">
    <thead>
    <tr>
        <th>Category</th>
        <th>Style</th>
        <th>SKU</th>
        <th>EAN</th>
        <th>Product Name</th>
        <th>Product Description</th>
        <th>Brand</th>
        <th>Color</th>
        <th>Color Description</th>
        <th>Size</th>
        <th>Size Description</th>
        {{--<th>Main Image</th>--}}
        {{--<th>Swatch Image</th>--}}
        {{--<th>Outfit</th>--}}
        {{--<th>image2</th>--}}
        {{--<th>image3</th>--}}
        {{--<th>image4</th>--}}
        <th>RuntoSize</th>
        <th>Care</th>
        <th>Price</th>
        <th>CostPrice</th>
        <th>WholePrice</th>
        <th>StockQty</th>
        <th>MinQtyAlert</th>
        <th>LastExportedBy</th>
        <th>LastExportedDate</th>
    </tr>
    </thead>
    <tbody>
    @foreach($productList as $list)
    <tr>
        <td>{{$list['categoryName']}}</td>
        <td>{{$list['style']}}</td>
        <td>{{$list['sku']}}</td>
        <td>{{$list['ean']}}</td>
        <td>{{$list['productName']}}</td>
        <td>{{$list['productDesc']}}</td>
        <td>{{$list['brand']}}</td>
        <td>{{$list['color']}}</td>
        <td>{{$list['colorDesc']}}</td>
        <td>{{$list['size']}}</td>
        <td>{{$list['sizeDescription']}}</td>
        {{--@if(!empty($list['mainImage']))--}}
        {{--<td><img src="{{$list['mainImage']}}"></td>--}}
        {{--@endif--}}
        {{--@if(!empty($list['swatchImage']))--}}
        {{--<td><img src="{{$list['swatchImage']}}"></td>--}}
        {{--@endif--}}
            {{--@if(!empty($list['outfit']))--}}
        {{--<td><img src="{{$list['outfit']}}"></td>--}}
        {{--@endif--}}
                {{--@if(!empty($list['image2']))--}}
        {{--<td><img src="{{$list['image2']}}"></td>--}}
        {{--@endif--}}
                    {{--@if(!empty($list['image3']))--}}
        {{--<td><img src="{{$list['image3']}}"></td>--}}
        {{--@endif--}}
                        {{--@if(!empty($list['image4']))--}}
        {{--<td><img src="{{$list['image4']}}"></td>--}}
        {{--@endif--}}
        <td>{{$list['runtosize']}}</td>
        <td>{{$list['care']}}</td>
        <td>{{$list['price']}}</td>
        <td>{{$list['costPrice']}}</td>
        <td>{{$list['wholePrice']}}</td>
        <td>{{$list['stockQty']}}</td>
        <td>{{$list['minQtyAlert']}}</td>
        <td>{{$list['LastExportedBy']}}</td>
        <td>{{$list['LastExportedDate']}}</td>
    </tr>
    @endforeach
    </tbody>
</table>