@foreach($ranks as $rank)
    <tr class="crud-item">
        <td>{{$rank->id}}</td>
        <td>{{$rank->name}}</td>
        <td class = "d-flex">
            @can('moderate')
                <a href="{{route('ranks.edit', $rank->id)}}" class="fa fa-pencil"></a>

                <a href="#" class="fa fa-remove delete-rank" data-url="{{route('ranks.destroy',
                    $rank->id)}}"></a>
            @endcan
        </td>
    </tr>
@endforeach

@if($ranks->lastPage() > 1)
    <tr>
        <td colspan="5">
            <div class="pull-right ranks-paginator">
                {{$ranks->onEachSide(3)->links()}}
            </div>
        </td>
    </tr>
@endif

<script>
	paginate({
       paginator: '.ranks-paginator',
       content: '.ranks-content',
       url: '{{route('ranks.paginate')}}',
       form: '.ranks-form'
    });

	remover('.delete-rank', '.crud-item');
</script>
