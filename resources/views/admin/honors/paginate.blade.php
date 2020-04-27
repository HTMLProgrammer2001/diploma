@foreach($honors as $honor)
    <tr>
        <td>{{$honor->id}}</td>
        <td>{{$honor->getUserName()}}</td>
        <td>{{$honor->title}}</td>
        <td>{{$honor->date_presentation}}</td>
        <td style="display: flex">

            @if($isProfile ?? false)
                <a href="{{route('profile.honors.edit', $honor->id)}}"
                   class="fa fa-pencil"></a>

                <form action="{{route('profile.honors.destroy', $honor->id)}}"
                      method="post">
                    @csrf
                    @method('DELETE')
                    <label for="delete_{{$honor->id}}"
                           onclick="return confirm('Ви впевнені?')">
                        <a class="fa fa-remove"></a>
                    </label>

                    <button type="submit" id="delete_{{$honor->id}}" class="hidden">
                    </button>
                </form>
            @else
                @can('moderate')
                    <a href="{{route('honors.edit', $honor->id)}}" class="fa fa-pencil"></a>

                    <form action="{{route('honors.destroy', $honor->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <label for="delete_{{$honor->id}}" onclick="return confirm('Ви впевнені?')">
                            <a class="fa fa-remove"></a>
                        </label>

                        <button type="submit" id="delete_{{$honor->id}}" class="hidden"></button>
                    </form>
                @endcan
            @endif

        </td>
    </tr>
@endforeach
