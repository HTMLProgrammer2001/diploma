@foreach($places as $place)
    <tr class="crud-item">
        <td>{{$place->id}}</td>
        <td>{{$place->name}}</td>
        <td>{{$place->address}}</td>
        <td class="d-flex">

            @can('moderate')
                <a href="{{route('places.edit', $place->id)}}" class="fa fa-pencil"></a>

                <a href="#" class="fa fa-remove delete-place" data-url="{{route('places.destroy',
                    $place->id)}}"></a>
            @endcan

        </td>
    </tr>
@endforeach

@if($places->lastPage() > 1)
    <tr>
        <td colspan="5">
            <div class="pull-right places-paginator">
                {{$places->onEachSide(3)->links()}}
            </div>
        </td>
    </tr>
@endif

<script>
	paginate({
       paginator: '.places-paginator',
       content: '.places-content',
       form: '.places-form',
       url: '{{route('places.paginate')}}'
    });

	remover('.delete-place', '.crud-item');
</script>
