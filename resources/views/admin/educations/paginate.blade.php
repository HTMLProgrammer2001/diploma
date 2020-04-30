@foreach($educations as $education)
    <tr class="crud-item">
        <td>{{$education->id}}</td>
        <td>{{$education->getUserName()}}</td>
        <td>{{$education->institution}}</td>
        <td>{{$education->graduate_year}}</td>
        <td>{{$education->qualification}}</td>
        <td style="display: flex">

            @if($isProfile ?? false)
                <a href="{{route('profile.educations.edit', $education->id)}}"
                   class="fa fa-pencil"></a>

                <a class="fa fa-remove deleteItem" data-url="{{route('profile.educations.destroy', $education->id)}}"></a>
            @else
                @can('moderate')
                    <a href="{{route('educations.edit', $education->id)}}" class="fa fa-pencil"></a>

                    <a class="fa fa-remove deleteItem" data-url="{{route('educations.destroy', $education->id)}}"></a>
                @endcan
            @endif

        </td>
    </tr>
@endforeach
