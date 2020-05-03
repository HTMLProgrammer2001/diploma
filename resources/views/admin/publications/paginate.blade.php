@foreach($publications as $publication)
    <tr class="crud-item">
        <td>{{$publication->id}}</td>
        <td>{{$publication->title}}</td>
        <td>{{$publication->getAuthorsString()}}</td>
        <td style="display: flex">
            @if($isProfile ?? false)
                <a href="{{route('profile.publications.edit', $publication->id)}}" class="fa fa-pencil"></a>

                <a class="fa fa-remove delete-publication" data-url="{{route('profile.publications.destroy',
                    $publication->id)}}"></a>
            @else
                @can('moderate')
                    <a href="{{route('publications.edit', $publication->id)}}" class="fa fa-pencil"></a>

                    <a class="fa fa-remove delete-publication" data-url="{{route('publications.destroy',
                    $publication->id)}}"></a>
                @endcan
            @endif

        </td>
    </tr>
@endforeach

<tr>
    <td colspan="5">
        <div class="pull-right publications-paginator">
            {{$publications->onEachSide(3)->links()}}
        </div>
    </td>
</tr>

<script>
	paginate('.publications-paginator', '.publications-content', '{{route('publications.paginate')}}', () => {
		remover('.delete-publication', '.crud-item');
	});
</script>
