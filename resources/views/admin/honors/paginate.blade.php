@foreach($honors as $honor)
    <tr class="crud-item">
        <td>{{$honor->id}}</td>
        <td>{{$honor->getUserName()}}</td>
        <td>{{$honor->title}}</td>
        <td>{{$honor->date_presentation}}</td>
        <td style="display: flex">

            @if($isProfile ?? false)
                <a href="{{route('profile.honors.edit', $honor->id)}}"
                   class="fa fa-pencil"></a>

                <a class="fa fa-remove deleteItem" data-url="{{route('profile.honors.destroy', $honor->id)}}"></a>
            @else
                @can('moderate')
                    <a href="{{route('honors.edit', $honor->id)}}" class="fa fa-pencil"></a>

                    <a class="fa fa-remove deleteItem" data-url="{{route('honors.destroy', $honor->id)}}"></a>
                @endcan
            @endif

        </td>
    </tr>
@endforeach
