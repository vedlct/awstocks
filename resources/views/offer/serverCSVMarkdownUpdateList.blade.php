
<table class="table">
    <thead>
    <tr style="font-weight:bold">
        <th>sku</th>
        <th>discount-price</th>
        <th>discount-start-date</th>
        <th>discount-end-date</th>



    </tr>
    </thead>
    <tbody>
    @foreach($productList as $list)
        <tr>
            <td>{{$list['sku']}}</td>
            <td>{{($list['price']-$list['disPrice'])}}</td>
            <td>{{$list['disStartPrice']}}</td>
            <td>{{$list['disEndPrice']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>