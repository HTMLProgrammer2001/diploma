@foreach($commissions as $commission)
    <tr>
        <td>{{$commission->id}}</td>
        <td>{{$commission->name}}</td>
        <td style="display: flex">

            @can('moderate')
                <a href="{{route('commissions.edit', $commission->id)}}" class="fa fa-pencil"></a>

                <form action="{{route('commissions.destroy', $commission->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <label for="delete_{{$commission->id}}" onclick="return confirm('Ви впевнені?')">
                        <a class="fa fa-remove"></a>
                    </label>

                    <button type="submit" id="delete_{{$commission->id}}" class="hidden"></button>
                </form>
            @endcan

        </td>
    </tr>
@endforeach
