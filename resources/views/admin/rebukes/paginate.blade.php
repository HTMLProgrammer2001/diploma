@foreach($rebukes as $rebuke)
    <tr class="crud-item">
        <td>{{$rebuke->id}}</td>
        <td>{{$rebuke->getUserName()}}</td>
        <td>{{$rebuke->title}}</td>
        <td>{{$rebuke->date_presentation}}</td>
        <td style="display: flex">

            @if($isProfile ?? false)
                <div></div>
            @else
                @can('moderate')
                    <a href="{{route('rebukes.edit', $rebuke->id)}}" class="fa fa-pencil"></a>
                    <a class="fa fa-remove delete-rebuke"
                       data-url="{{route('rebukes.destroy', $rebuke->id)}}"></a>
                @endcan
            @endif

        </td>
    </tr>
@endforeach

<tr>
    <td colspan="5">
        <div class="pull-right rebukes_paginator">
            {{$rebukes->onEachSide(3)->links()}}
        </div>
    </td>
</tr>

<script>
	paginate('.rebukes_paginator', '.rebuke-content', '{{route('rebukes.paginate')}}', () => {
		remover('.delete-rebuke', '.crud-item');
	});
</script>
