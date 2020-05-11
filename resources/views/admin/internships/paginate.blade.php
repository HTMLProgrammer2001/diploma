@foreach($internships as $internship)
    <tr class="crud-item">
        <td>{{$internship->id}}</td>
        <td>{{$internship->getUserShortName()}}</td>
        <td>{{$internship->getCategoryName()}}</td>
        <td>{{$internship->title}}</td>
        <td>{{$internship->hours}}</td>
        <td>{{$internship->to}}</td>
        <td>

            @if($isProfile ?? false)
                <a href="{{route('profile.internships.show', $internship->id)}}" class="fa fa-eye"></a>
                <a href="{{route('profile.internships.edit', $internship->id)}}" class="fa fa-pencil"></a>
                <a href="#" class="fa fa-remove delete-internship" data-url="{{route('profile.internships.destroy',
                    $internship->id)}}"></a>
            @else
                @can('view')
                    <a href="{{route('internships.show', $internship->id)}}" class="fa fa-eye"></a>
                @endcan

                @can('moderate')
                    <a href="{{route('internships.edit', $internship->id)}}" class="fa fa-pencil"></a>
                    <a href="#" class="fa fa-remove delete-internship" data-url="{{route('internships.destroy',
                    $internship->id)}}"></a>
                @endcan
            @endif
    </tr>
@endforeach

@if($internships->lastPage() > 1)
    <tr>
        <td colspan="10">
            <div class="pull-right internships-paginator">
                {{$internships->onEachSide(3)->links()}}
            </div>
        </td>
    </tr>
@endif

<script>
	paginate({
        paginator: '.internships-paginator',
        content: '.internships-content',
        form: '.internships-form',
        url: '{{isset($isProfile) ? route('profile.internships.paginate') : route('internships.paginate')}}'
    });

	remover('.delete-internship', '.crud-item');
</script>
