@foreach($departments as $department)
    <tr>
        <td>{{$department->id}}</td>
        <td>{{$department->name}}</td>
        <td style="display: flex">

            @can('moderate')
                <a href="{{route('departments.edit', $department->id)}}" class="fa fa-pencil"></a>

                <form action="{{route('departments.destroy', $department->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <label for="delete_{{$department->id}}" onclick="return confirm('Ви впевнені?')">
                        <a class="fa fa-remove"></a>
                    </label>

                    <button type="submit" id="delete_{{$department->id}}" class="hidden"></button>
                </form>
            @endcan

        </td>
    </tr>
@endforeach
