@foreach($departments as $department)
    <tr class="crud-item">
        <td>{{$department->id}}</td>
        <td>{{$department->name}}</td>
        <td style="display: flex">

            @can('moderate')
                <a href="{{route('departments.edit', $department->id)}}" class="fa fa-pencil"></a>

                <a class="fa fa-remove deleteItem" data-url="{{route('departments.destroy',
                    $department->id)}}"></a>
            @endcan

        </td>
    </tr>
@endforeach
