@foreach($commissions as $commission)
    <tr class="crud-item">
        <td>{{$commission->id}}</td>
        <td>{{$commission->name}}</td>
        <td class="d-flex">

            @can('moderate')
                <a href="{{route('commissions.edit', $commission->id)}}" class="fa fa-pencil"></a>

                <a href="#" class="fa fa-remove delete-commission" data-url="{{route('commissions.destroy',
                    $commission->id)}}"></a>
            @endcan

        </td>
    </tr>
@endforeach

@if($commissions->lastPage() > 1)
    <tr>
        <td colspan="10">
            <div class="pull-right commissions-paginator">
                {{$commissions->onEachSide(3)->links()}}
            </div>
        </td>
    </tr>
@endif

<script>
	table({
        paginator: '.commissions-paginator',
        content: '.commissions-content',
        url: '{{route('commissions.paginate')}}',
        sort: '.commissions-sort',
        form: '.commissions-form'
    });

	remover('.delete-commission', '.crud-item');
</script>
