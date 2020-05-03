@foreach($commissions as $commission)
    <tr class="crud-item">
        <td>{{$commission->id}}</td>
        <td>{{$commission->name}}</td>
        <td style="display: flex">

            @can('moderate')
                <a href="{{route('commissions.edit', $commission->id)}}" class="fa fa-pencil"></a>

                <a class="fa fa-remove delete-commission" data-url="{{route('commissions.destroy',
                    $commission->id)}}"></a>
            @endcan

        </td>
    </tr>
@endforeach

<tr>
    <td colspan="10">
        <div class="pull-right commissions-paginator">
            {{$commissions->onEachSide(3)->links()}}
        </div>
    </td>
</tr>

<script>
	paginate('.commissions-paginator', '.commissions-content', '{{route('commissions.paginate')}}', () => {
		remover('.delete-commission', '.crud-item');
	});
</script>
