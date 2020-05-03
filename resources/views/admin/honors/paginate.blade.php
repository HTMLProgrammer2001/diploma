@foreach($honors as $honor)
    <tr class="crud-item">
        <td>{{$honor->id}}</td>
        <td>{{$honor->getUserName()}}</td>
        <td>{{$honor->title}}</td>
        <td>{{$honor->date_presentation}}</td>
        <td style="display: flex">

            @if($isProfile ?? false)
                <div></div>
            @else
                @can('moderate')
                    <a href="{{route('honors.edit', $honor->id)}}" class="fa fa-pencil"></a>

                    <a class="fa fa-remove delete-honor" data-url="{{route('honors.destroy', $honor->id)}}"></a>
                @endcan
            @endif

        </td>
    </tr>
@endforeach

<tr>
    <td colspan="10">
        <div class="pull-right honors-paginator">
            {{$honors->onEachSide(3)->links()}}
        </div>
    </td>
</tr>

<script>
	paginate('.honors-paginator', '.honors-content', '{{route('honors.paginate')}}', () => {
		remover('.delete-honor', '.crud-item');
	});
</script>

