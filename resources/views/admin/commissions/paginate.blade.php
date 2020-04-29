@foreach($commissions as $commission)
    <tr class="crud-item">
        <td>{{$commission->id}}</td>
        <td>{{$commission->name}}</td>
        <td style="display: flex">

            @can('moderate')
                <a href="{{route('commissions.edit', $commission->id)}}" class="fa fa-pencil"></a>

                <a class="fa fa-remove deleteItem" data-url="{{route('commissions.destroy',
                    $commission->id)}}"></a>
            @endcan

        </td>
    </tr>
@endforeach
