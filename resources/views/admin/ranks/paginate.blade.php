@foreach($ranks as $rank)
    <tr class="crud-item">
        <td>{{$rank->id}}</td>
        <td>{{$rank->name}}</td>
        <td style="display: flex">
            @can('moderate')
                <a href="{{route('ranks.edit', $rank->id)}}" class="fa fa-pencil"></a>

                <a class="fa fa-remove deleteItem" data-url="{{route('ranks.destroy',
                    $rank->id)}}"></a>
            @endcan
        </td>
    </tr>
@endforeach
