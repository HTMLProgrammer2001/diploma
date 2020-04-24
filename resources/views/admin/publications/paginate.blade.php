@foreach($publications as $publication)
    <tr>
        <td>{{$publication->id}}</td>
        <td>{{$publication->title}}</td>
        <td>{{$publication->getAuthorsString()}}</td>
        <td style="display: flex">

            @can('moderate')
                <a href="{{route('publications.edit', $publication->id)}}" class="fa fa-pencil"></a>

                <form action="{{route('publications.destroy', $publication->id)}}" method="post">
                    @csrf
                    @method('DELETE')

                    <label for="delete_{{$publication->id}}" onclick="return confirm('Ви впевнені?')">
                        <a class="fa fa-remove"></a>
                    </label>

                    <button type="submit" id="delete_{{$publication->id}}" class="hidden"></button>
                </form>
            @endcan

        </td>
    </tr>
@endforeach
