<table class="table">
    <thead>
    <tr>
        <th>Color Name</th>
        <th>Description</th>
        <th>Type</th>
    </tr>
    </thead>
    <tbody>
    @foreach($colors as $color)
    <tr>
        <td>{{$color->colorName}}</td>
        <td>{{$color->colorDescription}}</td>
        <td>{{$color->colorType}}</td>
    </tr>
        @endforeach

    </tbody>
</table>