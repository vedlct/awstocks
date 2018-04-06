<table class="table">
    <thead>
    <tr>
        <th>sku</th>
        <th>price</th>

    </tr>
    </thead>
    <tbody>
    @foreach($productList as $list)
        <tr>
            <td>{{$list['sku']}}</td>
            <td>{{$list['price']}}</td>

        </tr>
    @endforeach
    </tbody>
</table>