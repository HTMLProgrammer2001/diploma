@foreach($internships as $internship)
    <tr>
        <td>{{$internship->id}}</td>
        <td>{{$internship->getUserShortName()}}</td>
        <td>{{$internship->getCategoryName()}}</td>
        <td>{{$internship->title}}</td>
        <td>{{$internship->hours}}</td>
        <td>
            @can('moderate')
                <a href="{{route('internships.edit', $internship->id)}}" class="fa fa-pencil"></a>
                <form action="{{route('internships.destroy', $internship->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <label for="delete_{{$internship->id}}" onclick="return confirm('Ви впевнені?')">
                        <a class="fa fa-remove"></a>
                    </label>

                    <button type="submit" id="delete_{{$internship->id}}" class="hidden"></button>
                </form>
        @endcan
    </tr>
@endforeach
