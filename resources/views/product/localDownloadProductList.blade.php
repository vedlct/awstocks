
<table class="table">
    <thead>
    <tr>
        <th>Category</th>
        <th>Style</th>
        <th>SKU</th>
        <th>EAN</th>
        <th>Product name</th>
        <th >Product description</th>
        <th>Brand</th>
        <th>Product Location</th>
        <th>Color</th>
        <th >Color Description</th>
        <th>Size</th>
        <th>Size Description</th>
        <th>Main Image</th>
        <th>Swatch Image</th>
        <th>Outfit</th>
        <th>image2</th>
        <th>image3</th>
        <th>image4</th>
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
        <td valign="middle">{{$list['categoryName']}}</td>
        <td valign="middle">{{$list['style']}}</td>
        <td valign="middle">{{$list['sku']}}</td>
        <td valign="middle">{{$list['ean']}}</td>
        <td valign="middle">{{$list['productName']}}</td>
        <td  valign="middle"width="50">{{$list['productDesc']}}</td>
        <td valign="middle">{{$list['brand']}}</td>
        <td valign="middle"width="20" >{{$list['location']}}</td>
        <td valign="middle">{{$list['color']}}</td>
        <td  valign="middle"width="30">{{$list['colorDesc']}}</td>
        <td valign="middle">{{$list['size']}}</td>
        <td  valign="middle"width="30">{{$list['sizeDescription']}}</td>
        @if(!empty($list['mainImage']))
        <td valign="middle"><img src="{{public_path('productImage/thumb')."/".basename($list['mainImage'])}}" width="100px" height="100px"/></td>
            @else
            <td></td>
        @endif
        @if(!empty($list['swatchImage']))
        <td valign="middle"><img src="{{public_path('productImage/thumb')."/".basename($list['swatchImage'])}}"width="100px" height="100px"/></td>
        @else
            <td></td>
        @endif
            @if(!empty($list['outfit']))
        <td valign="middle"><img src="{{public_path('productImage/thumb')."/".basename($list['outfit'])}}"width="100px" height="100px"/></td>
        @else
            <td></td>
        @endif
                @if(!empty($list['image2']))
        <td valign="middle"><img src="{{public_path('productImage/thumb')."/".basename($list['image2'])}}"width="100px" height="100px"/></td>
        @else
            <td></td>
        @endif
                    @if(!empty($list['image3']))
        <td valign="middle"><img src="{{public_path('productImage/thumb')."/".basename($list['image3'])}}"width="100px" height="100px"/></td>
        @else
            <td></td>
        @endif
                        @if(!empty($list['image4']))
        <td valign="middle"><img src="{{public_path('productImage/thumb')."/".basename($list['image4'])}}"width="100px" height="100px"/></td>
        @else
            <td></td>

        @endif
        <td valign="middle">{{$list['runtosize']}}</td>
        <td valign="middle">{{$list['care']}}</td>
        <td valign="middle">{{$list['price']}}</td>
        <td valign="middle">{{$list['costPrice']}}</td>
        <td valign="middle">{{$list['wholePrice']}}</td>
        <td valign="middle">{{$list['stockQty']}}</td>
        <td valign="middle">{{$list['minQtyAlert']}}</td>
        <td valign="middle">{{$list['LastExportedBy']}}</td>
        <td valign="middle">{{$list['LastExportedDate']}}</td>
    </tr>
    @endforeach
    </tbody>
</table>