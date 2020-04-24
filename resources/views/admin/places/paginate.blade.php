@foreach($places as $place)
    <tr>
        <td>{{$place->id}}</td>
        <td>{{$place->name}}</td>
        <td>{{$place->address}}</td>
        <td style="display: flex">

            @can('moderate')
                <a href="{{route('places.edit', $place->id)}}" class="fa fa-pencil"></a>

                <form action="{{route('places.destroy', $place->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <label for="delete_{{$place->id}}" onclick="return confirm('Ви впевнені?')">
                        <a class="fa fa-remove"></a>
                    </label>

                    <button type="submit" id="delete_{{$place->id}}" class="hidden"></button>
                </form>
            @endcan

        </td>
    </tr>
@endforeach
