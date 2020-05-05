@foreach($ranks as $rank)
    <tr class="crud-item">
        <td>{{$rank->id}}</td>
        <td>{{$rank->name}}</td>
        <td style="display: flex">
            @can('moderate')
                <a href="{{route('ranks.edit', $rank->id)}}" class="fa fa-pencil"></a>

                <a class="fa fa-remove delete-rank" data-url="{{route('ranks.destroy',
                    $rank->id)}}"></a>
            @endcan
        </td>
    </tr>
@endforeach

<tr>
    <td colspan="5">
        <div class="pull-right ranks_paginator">
            {{$ranks->onEachSide(3)->links()}}
        </div>
    </td>
</tr>

<script>
	paginate('.ranks_paginator', '.ranks-content', '{{route('ranks.paginate')}}');

	remover('.delete-rank', '.crud-item');
</script>
