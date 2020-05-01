@foreach($rebukes as $rebuke)
    <tr class="crud-item">
        <td>{{$rebuke->id}}</td>
        <td>{{$rebuke->getUserName()}}</td>
        <td>{{$rebuke->title}}</td>
        <td>{{$rebuke->date_presentation}}</td>
        <td style="display: flex">

            @if($isProfile ?? false)
                <div></div>
            @else
                @can('moderate')
                    <a href="{{route('rebukes.edit', $rebuke->id)}}" class="fa fa-pencil"></a>
                    <a class="fa fa-remove deleteItem" data-url="{{route('rebukes.destroy', $rebuke->id)}}"></a>
                @endcan
            @endif

        </td>
    </tr>
@endforeach
