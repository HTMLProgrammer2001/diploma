@foreach($places as $place)
    <tr class="crud-item">
        <td>{{$place->id}}</td>
        <td>{{$place->name}}</td>
        <td>{{$place->address}}</td>
        <td style="display: flex">

            @can('moderate')
                <a href="{{route('places.edit', $place->id)}}" class="fa fa-pencil"></a>

                <a class="fa fa-remove delete-place" data-url="{{route('places.destroy',
                    $place->id)}}"></a>
            @endcan

        </td>
    </tr>
@endforeach

<tr>
    <td colspan="5">
        <div class="pull-right places-paginator">
            {{$places->onEachSide(3)->links()}}
        </div>
    </td>
</tr>

<script>
	paginate('.places-paginator', '.places-content', '{{route('places.paginate')}}', () => {
		remover('.delete-place', '.crud-item');
	});
</script>
