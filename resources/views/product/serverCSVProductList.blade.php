<table class="table">
    <thead>
    <tr>
        <th>Product category</th>
        <th>Style</th>
        <th>SKU</th>

        <th>Product name</th>
        <th>Product description</th>
        <th>Brand name</th>
        <th>Standard colour</th>
        <th>Detailed colour</th>

        <th>Swatch</th>

        <th>Size</th>

        <th>Main image</th>

        <th>Outfit</th>
        <th>Image 2</th>

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

                <td>{{$url.'public/productImage/'.$list['swatchImage']}}</td>
            @else
                <td></td>
            @endif

            <td>{{$list['size']}}</td>

            @if(!empty($list['mainImage']))

                <td>{{$url.'public/productImage/'.$list['mainImage']}}</td>
            @else
                <td></td>
            @endif

            @if(!empty($list['outfit']))
                <td>{{$url.'public/productImage/'.$list['outfit']}}</td>
            @else
                <td></td>
            @endif
            @if(!empty($list['image2']))
                <td>{{$url.'public/productImage/'.$list['image2']}}</td>
            @else
                <td></td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>