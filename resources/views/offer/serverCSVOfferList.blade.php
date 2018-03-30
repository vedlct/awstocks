
<table class="table">
    <thead>
    <tr>
        <th>Product Name</th>
        <th>Category</th>
        <th>dis price</th>
        <th>Product-id-type</th>
        <th>State</th>
        <th>Status</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>LastExportedDate</th>


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