<table class="table">
    <thead>
    <tr>
        <th>Category</th>
        <th>Style</th>
        <th>SKU</th>

        <th>Product Name</th>
        <th>Product Description</th>
        <th>Brand</th>
        <th>Color</th>
        <th>Color Description</th>

        <th>Swatch Image</th>

        <th>Size</th>

        <th>Main Image</th>

        <th>Outfit</th>
        <th>image2</th>

    </tr>
    </thead>
    <tbody>
    @foreach($productList as $list)
        <tr>
            <td>{{$list['categoryName']}}</td>
            <td>{{$list['style']}}</td>
            <td>{{$list['sku']}}</td>
            <td>{{$list['productName']}}</td>
            <td>{{$list['productDesc']}}</td>
            <td>{{$list['brand']}}</td>
            <td>{{$list['color']}}</td>
            <td>{{$list['colorDesc']}}</td>

            @if(!empty($list['swatchImage']))
                <td><img src="{{public_path('productImage/').basename($list['swatchImage'])}}"width="100px" height="100px"></td>
            @else
                <td></td>
            @endif

            <td>{{$list['size']}}</td>

            @if(!empty($list['mainImage']))

                <td><img src="{{public_path('productImage/').basename($list['mainImage'])}}" width="100px" height="100px"></td>
            @else
                <td></td>
            @endif

            @if(!empty($list['outfit']))
                <td><img src="{{public_path('productImage/').basename($list['outfit'])}}"width="100px" height="100px"></td>
            @else
                <td></td>
            @endif
            @if(!empty($list['image2']))
                <td><img src="{{public_path('productImage/').basename($list['image2'])}}"width="100px" height="100px"></td>
            @else
                <td></td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>