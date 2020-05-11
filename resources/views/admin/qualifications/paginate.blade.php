@foreach($qualifications as $qualification)
    <tr class="crud-item">
        <td>{{$qualification->id}}</td>
        <td>{{$qualification->getUserShortName()}}</td>
        <td>{{$qualification->name}}</td>
        <td>{{$qualification->date}}</td>
        <td>
            @if($isProfile ?? false)
                <a href="{{route('profile.qualifications.show', $qualification->id)}}" class="fa fa-eye"></a>
                <a href="#" class="fa fa-remove delete-qualification" data-url="{{route('profile.qualifications.destroy',
                    $qualification->id)}}"></a>
            @else
                @can('view')
                    <a href="{{route('qualifications.show', $qualification->id)}}" class="fa fa-eye"></a>
                @endcan

                @can('moderate')
                    <a href="{{route('qualifications.edit', $qualification->id)}}"
                        class="fa fa-pencil"></a>

                    <a href="#" class="fa fa-remove delete-qualification" data-url="{{route('qualifications.destroy',
                    $qualification->id)}}"></a>
                @endcan
            @endif
    </tr>
@endforeach

@if($qualifications->lastPage() > 1)
    <tr>
        <td colspan="5">
            <div class="pull-right qualifications-paginator">
                {{$qualifications->onEachSide(3)->links()}}
            </div>
        </td>
    </tr>
@endif

<script>
	paginate({
        paginator: '.qualifications-paginator',
        content: '.qualifications-content',
        form: '.qualifications-form',
        url: '{{isset($isProfile) ? route('profile.qualifications.paginate') : route('qualifications.paginate')}}'
    });

	remover('.delete-qualification', '.crud-item');
</script>
