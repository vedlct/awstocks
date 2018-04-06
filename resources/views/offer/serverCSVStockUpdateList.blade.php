
<table class="table">
    <thead>
    <tr>
        <th>sku</th>
        <th>quantity</th>



    </tr>
    </thead>
    <tbody>
    @foreach($productList as $list)
        <tr>
            <td>{{$list['sku']}}</td>
            <td>{{$list['stockQty']}}</td>


        </tr>
    @endforeach
    </tbody>
</table>