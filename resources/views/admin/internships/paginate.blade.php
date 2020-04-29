@foreach($internships as $internship)
    <tr class="crud-item">
        <td>{{$internship->id}}</td>
        <td>{{$internship->getUserShortName()}}</td>
        <td>{{$internship->getCategoryName()}}</td>
        <td>{{$internship->title}}</td>
        <td>{{$internship->hours}}</td>
        <td>

            @if($isProfile ?? false)
                <a href="{{route('profile.internships.edit', $internship->id)}}" class="fa fa-pencil"></a>
                <a class="fa fa-remove deleteItem" data-url="{{route('profile.internships.destroy',
                    $internship->id)}}"></a>
            @else
                @can('moderate')
                    <a href="{{route('internships.edit', $internship->id)}}" class="fa fa-pencil"></a>
                    <a class="fa fa-remove deleteItem" data-url="{{route('internships.destroy',
                    $internship->id)}}"></a>
                @endcan
            @endif
    </tr>
@endforeach
