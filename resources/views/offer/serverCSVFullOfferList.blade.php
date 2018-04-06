<table class="table">
    <thead>
    <tr>
        <th>sku</th>
        <th>price</th>
        <th>quantity</th>
        <th>state</th>
        <th>product-id-type</th>
        <th>product-id</th>
    </tr>
    </thead>
    <tbody>
    @foreach($productList as $list)
        <tr>
            <td>{{$list['sku']}}</td>
            <td>{{$list['price']}}</td>
            <td>{{$list['stockQty']}}</td>
            <td>{{$list['state']}}</td>
            <td>{{$list['product-id-type']}}</td>
            <td>{{$list['product-Id']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>