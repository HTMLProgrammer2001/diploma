@foreach($places as $place)
    <tr class="crud-item">
        <td>{{$place->id}}</td>
        <td>{{$place->name}}</td>
        <td>{{$place->address}}</td>
        <td style="display: flex">

            @can('moderate')
                <a href="{{route('places.edit', $place->id)}}" class="fa fa-pencil"></a>

                <a class="fa fa-remove deleteItem" data-url="{{route('places.destroy',
                    $place->id)}}"></a>
            @endcan

        </td>
    </tr>
@endforeach
