@foreach($qualifications as $qualification)
    <tr class="crud-item">
        <td>{{$qualification->id}}</td>
        <td>{{$qualification->getUserShortName()}}</td>
        <td>{{$qualification->name}}</td>
        <td>{{$qualification->date}}</td>
        <td>
            @if($isProfile ?? false)
                <a class="fa fa-remove delete-qualification" data-url="{{route('profile.qualifications.destroy',
                    $qualification->id)}}"></a>
            @else
                @can('moderate')
                    <a href="{{route('qualifications.edit', $qualification->id)}}"
                        class="fa fa-pencil"></a>

                    <a class="fa fa-remove delete-qualification" data-url="{{route('qualifications.destroy',
                    $qualification->id)}}"></a>
                @endcan
            @endif
    </tr>
@endforeach

<tr>
    <td colspan="5">
        <div class="pull-right qualifications-paginator">
            {{$qualifications->onEachSide(3)->links()}}
        </div>
    </td>
</tr>

<script>
	paginate('.qualifications-paginator', '.qualifications-content', '{{route('qualifications.paginate')}}', () => {
		remover('.delete-qualification', '.crud-item');
	});
</script>
