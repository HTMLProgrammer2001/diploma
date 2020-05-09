@foreach($rebukes as $rebuke)
    <tr class="crud-item">
        <td>{{$rebuke->id}}</td>
        <td>{{$rebuke->getUserName()}}</td>
        <td>{{$rebuke->title}}</td>
        <td>{{$rebuke->date_presentation}}</td>
        <td class="d-flex">

            @if($isProfile ?? false)
                <div></div>
            @else
                @can('moderate')
                    <a href="{{route('rebukes.edit', $rebuke->id)}}" class="fa fa-pencil"></a>
                    <a href="#" class="fa fa-remove delete-rebuke"
                       data-url="{{route('rebukes.destroy', $rebuke->id)}}"></a>
                @endcan
            @endif

        </td>
    </tr>
@endforeach

@if($rebukes->lastPage() > 1)
    <tr>
        <td colspan="5">
            <div class="pull-right rebukes-paginator">
                {{$rebukes->onEachSide(3)->links()}}
            </div>
        </td>
    </tr>
@endif

<script>
	paginate({
        paginator: '.rebukes-paginator',
        content: '.rebukes-content',
        form: '.rebukes-form',
        url: '{{isset($isProfile) ? route('profile.rebukes.paginate') : route('rebukes.paginate')}}'
    });

	remover('.delete-rebuke', '.crud-item');
</script>
