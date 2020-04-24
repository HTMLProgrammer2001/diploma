@foreach($categories as $category)
    <tr>
        <td>{{$category->id}}</td>
        <td>{{$category->name}}</td>
        <td style="display: flex">
            @can('moderate')
                <a href="{{route('categories.edit', $category->id)}}" class="fa fa-pencil"></a>

                <form action="{{route('categories.destroy', $category->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <label for="delete_{{$category->id}}" onclick="return confirm('Ви впевнені?')">
                        <a class="fa fa-remove"></a>
                    </label>

                    <button type="submit" id="delete_{{$category->id}}" class="hidden"></button>
                </form>
            @endcan
        </td>
    </tr>
@endforeach
