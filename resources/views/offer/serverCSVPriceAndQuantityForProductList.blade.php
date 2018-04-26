<table class="table">
    <thead>
    <tr>
        <th>sku</th>
        <th>price</th>
        <th>quantity</th>
        <th>product-id-type</th>
        <th>product-id</th>
        <th>state</th>
        <th>min-quantity-alert</th>
    </tr>
    </thead>
    <tbody>
    @foreach($productList as $list)
    <tr>
        <td>{{$list['sku']}}</td>
        <td>{{$list['price']}}</td>
        <td>{{$list['stockQty']}}</td>
        <td>SHOP_SKU</td>
        <td>{{$list['product-Id']}}</td>
        <td>11</td>
        <td>{{$list['minQtyAlert']}}</td>
    </tr>
    @endforeach
    </tbody>
</table>