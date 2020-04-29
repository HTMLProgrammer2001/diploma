@foreach($rebukes as $rebuke)
    <tr class="crud-item">
        <td>{{$rebuke->id}}</td>
        <td>{{$rebuke->getUserName()}}</td>
        <td>{{$rebuke->title}}</td>
        <td>{{$rebuke->date_presentation}}</td>
        <td style="display: flex">

            @if($isProfile ?? false)
                <a href="{{route('profile.rebukes.edit', $rebuke->id)}}"
                   class="fa fa-pencil"></a>

                <form action="{{route('profile.rebukes.destroy', $rebuke->id)}}"
                      method="post">
                    @csrf
                    @method('DELETE')
                    <label for="delete_{{$rebuke->id}}"
                           onclick="return confirm('Ви впевнені?')">
                        <a class="fa fa-remove"></a>
                    </label>

                    <button type="submit" id="delete_{{$rebuke->id}}" class="hidden">
                    </button>
                </form>
            @else
                @can('moderate')
                    <a href="{{route('rebukes.edit', $rebuke->id)}}" class="fa fa-pencil"></a>
                    <a class="fa fa-remove deleteItem" data-url="{{route('rebukes.destroy', $rebuke->id)}}"></a>
                @endcan
            @endif

        </td>
    </tr>
@endforeach
