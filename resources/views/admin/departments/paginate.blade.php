@foreach($departments as $department)
    <tr class="crud-item">
        <td>{{$department->id}}</td>
        <td>{{$department->name}}</td>
        <td style="display: flex">

            @can('moderate')
                <a href="{{route('departments.edit', $department->id)}}" class="fa fa-pencil"></a>

                <a class="fa fa-remove deleteItem" data-url="{{route('departments.destroy',
                    $department->id)}}"></a>
            @endcan

        </td>
    </tr>
@endforeach

<tr>
    <td colspan="10">
        <div class="pull-right departments-paginator">
            {{$departments->onEachSide(3)->links()}}
        </div>
    </td>
</tr>

<script>
	paginate('.departments-paginator', '.departments-content', '{{route('departments.paginate')}}', () => {
		remover('.delete-department', '.crud-item');
	});
</script>
