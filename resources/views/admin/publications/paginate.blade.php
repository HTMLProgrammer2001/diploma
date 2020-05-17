@foreach($publications as $publication)
    <tr class="crud-item">
        <td>{{$publication->id}}</td>
        <td>{{$publication->title}}</td>
        <td>{{$publication->getAuthorsString()}}</td>
        <td>{{to_locale_date($publication->date_of_publication)}}</td>
        <td class="d-flex">
            @if($isProfile ?? false)
                <a href="{{route('profile.publications.show', $publication->id)}}" class="fa fa-eye"></a>
                <a href="{{route('profile.publications.edit', $publication->id)}}" class="fa fa-pencil"></a>
                <a href="#" class="fa fa-remove delete-publication" data-url="{{route('profile.publications.destroy',
                    $publication->id)}}"></a>
            @else
                @can('view')
                    <a href="{{route('publications.show', $publication->id)}}" class="fa fa-eye"></a>
                @endcan

                @can('moderate')
                    <a href="{{route('publications.edit', $publication->id)}}" class="fa fa-pencil"></a>

                    <a href="#" class="fa fa-remove delete-publication" data-url="{{route('publications.destroy',
                    $publication->id)}}"></a>
                @endcan
            @endif

        </td>
    </tr>
@endforeach

@if($publications->lastPage() > 1)
    <tr>
        <td colspan="5">
            <div class="pull-right publications-paginator">
                {{$publications->onEachSide(3)->links()}}
            </div>
        </td>
    </tr>
@endif

<script>
	table({
        paginator: '.publications-paginator',
        content: '.publications-content',
        url: '{{isset($isProfile) ? route('profile.publications.paginate') : route('publications.paginate')}}',
        form: '.publications-form',
        sort: '.publications-sort'
    });

	remover('.delete-publication', '.crud-item');
</script>
