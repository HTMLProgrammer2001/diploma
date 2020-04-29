@foreach($publications as $publication)
    <tr class="crud-item">
        <td>{{$publication->id}}</td>
        <td>{{$publication->title}}</td>
        <td>{{$publication->getAuthorsString()}}</td>
        <td style="display: flex">
            @if($isProfile ?? false)
                <a href="{{route('profile.publications.edit', $publication->id)}}" class="fa fa-pencil"></a>

                <a class="fa fa-remove deleteItem" data-url="{{route('profile.publications.destroy',
                    $publication->id)}}"></a>
            @else
                @can('moderate')
                    <a href="{{route('publications.edit', $publication->id)}}" class="fa fa-pencil"></a>

                    <a class="fa fa-remove deleteItem" data-url="{{route('publications.destroy',
                    $publication->id)}}"></a>
                @endcan
            @endif

        </td>
    </tr>
@endforeach
