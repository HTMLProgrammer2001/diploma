@foreach($qualifications as $qualification)
    <tr>
        <td>{{$qualification->id}}</td>
        <td>{{$qualification->getUserShortName()}}</td>
        <td>{{$qualification->name}}</td>
        <td>{{$qualification->date}}</td>
        <td>
            @if($isProfile ?? false)
                <a href="{{route('profile.qualifications.edit', $qualification->id)}}"
                   class="fa fa-pencil"></a>

                <form action="{{route('profile.qualifications.destroy', $qualification->id)}}"
                      method="post">
                    @csrf
                    @method('DELETE')
                    <label for="delete_{{$qualification->id}}"
                           onclick="return confirm('Ви впевнені?')">
                        <a class="fa fa-remove"></a>
                    </label>

                    <button type="submit" id="delete_{{$qualification->id}}" class="hidden">
                    </button>
                </form>
            @else
                @can('moderate')
                    <a href="{{route('qualifications.edit', $qualification->id)}}"
                        class="fa fa-pencil"></a>

                    <form action="{{route('qualifications.destroy', $qualification->id)}}"
                          method="post">
                        @csrf
                        @method('DELETE')
                        <label for="delete_{{$qualification->id}}"
                               onclick="return confirm('Ви впевнені?')">
                            <a class="fa fa-remove"></a>
                        </label>

                        <button type="submit" id="delete_{{$qualification->id}}" class="hidden"></button>
                    </form>
                @endcan
            @endif
    </tr>
@endforeach
