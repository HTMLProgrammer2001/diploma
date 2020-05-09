@foreach($honors as $honor)
    <tr class="crud-item">
        <td>{{$honor->id}}</td>
        <td>{{$honor->getUserName()}}</td>
        <td>{{$honor->title}}</td>
        <td>{{$honor->date_presentation}}</td>
        <td class="d-flex">

            @if($isProfile ?? false)
                <div></div>
            @else
                @can('moderate')
                    <a href="{{route('honors.edit', $honor->id)}}" class="fa fa-pencil"></a>

                    <a href="#" class="fa fa-remove delete-honor" data-url="{{route('honors.destroy', $honor->id)}}"></a>
                @endcan
            @endif

        </td>
    </tr>
@endforeach

@if($honors->lastPage() > 1)
    <tr>
        <td colspan="10">
            <div class="pull-right honors-paginator">
                {{$honors->onEachSide(3)->links()}}
            </div>
        </td>
    </tr>
@endif

<script>
	paginate({
       paginator: '.honors-paginator',
       content: '.honors-content',
       form: '.honors-form',
       url: '{{isset($isProfile) ? route('profile.honors.paginate') : route('honors.paginate')}}'
    });

	remover('.delete-honor', '.crud-item');
</script>
