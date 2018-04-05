
<table class="table">
    <thead>
    <tr>
        <th>product name</th>
        <th>category</th>
        <th>discount-price</th>
        <th>product-id-type</th>
        <th>state</th>
        <th>status</th>
        <th>start-date</th>
        <th>end-date</th>
        <th>lastExportedDate</th>


    </tr>
    </thead>
    <tbody>
    @foreach($productList as $list)
        <tr>
            <td>{{$list['productName']}}</td>
            <td>{{$list['categoryName']}}</td>
            <td>{{$list['disPrice']}}</td>
            <td>{{$list['product-id-type']}}</td>
            <td>{{$list['state']}}</td>
            <td>{{$list['status']}}</td>
            <td>{{$list['disStartPrice']}}</td>
            <td>{{$list['disEndPrice']}}</td>
            <td>{{$list['lastExportedDate']}}</td>

        </tr>
    @endforeach
    </tbody>
</table>