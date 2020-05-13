@foreach($educations as $education)
    <tr class="crud-item">
        <td>{{$education->id}}</td>
        <td>{{$education->getUserName()}}</td>
        <td>{{$education->institution}}</td>
        <td>{{$education->graduate_year}}</td>
        <td>{{$education->qualification}}</td>
        <td class="d-flex">

            @if($isProfile ?? false)
                <a href="{{route('profile.educations.show', $education->id)}}" class="fa fa-eye"></a>

                <a href="{{route('profile.educations.edit', $education->id)}}"
                   class="fa fa-pencil"></a>

                <a href="#" class="fa fa-remove delete-education" data-url="{{route('profile.educations.destroy', $education->id)}}"></a>
            @else
                @can('view')
                    <a href="{{route('educations.show', $education->id)}}" class="fa fa-eye"></a>
                @endcan

                @can('moderate')
                    <a href="{{route('educations.edit', $education->id)}}" class="fa fa-pencil"></a>

                    <a href ="#" class="fa fa-remove delete-education"
                       data-url="{{route('educations.destroy', $education->id)}}"></a>
                @endcan
            @endif

        </td>
    </tr>
@endforeach

@if($educations->lastPage() > 1)
    <tr>
        <td colspan="10">
            <div class="pull-right educations-paginator">
                {{$educations->onEachSide(3)->links()}}
            </div>
        </td>
    </tr>
@endif

<script>
	table({
        paginator: '.educations-paginator',
        content: '.educations-content',
        form: '.educations-form',
        sort: '.educations-sort',
        url: '{{isset($isProfile) ? route('profile.educations.paginate') : route('educations.paginate')}}'
    });

	remover('.delete-education', '.crud-item');
</script>
