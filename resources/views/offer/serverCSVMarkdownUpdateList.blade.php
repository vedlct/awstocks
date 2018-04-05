
<table class="table">
    <thead>
    <tr>
        <th>SKU</th>

        <th>dis price</th>



    </tr>
    </thead>
    <tbody>
    @foreach($productList as $list)
        <tr>
            <td>{{$list['sku']}}</td>
            <td>{{($list['price']-$list['disPrice'])}}</td>

        </tr>
    @endforeach
    </tbody>
</table>