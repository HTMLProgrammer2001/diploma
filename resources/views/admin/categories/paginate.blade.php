@foreach($categories as $category)
    <tr class="crud-item">
        <td>{{$category->id}}</td>
        <td>{{$category->name}}</td>
        <td style="display: flex">
            @can('moderate')
                <a href="{{route('categories.edit', $category->id)}}" class="fa fa-pencil"></a>

                <a class="fa fa-remove deleteItem" data-url="{{route('categories.destroy',
                    $category->id)}}"></a>
            @endcan
        </td>
    </tr>
@endforeach
