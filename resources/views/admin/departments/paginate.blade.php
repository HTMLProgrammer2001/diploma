@foreach($departments as $department)
    <tr class="crud-item">
        <td>{{$department->id}}</td>
        <td>{{$department->name}}</td>
        <td class="d-flex">

            @can('moderate')
                <a href="{{route('departments.edit', $department->id)}}" class="fa fa-pencil"></a>

                <a href="#" class="fa fa-remove delete-department" data-url="{{route('departments.destroy',
                    $department->id)}}"></a>
            @endcan

        </td>
    </tr>
@endforeach

@if($departments->lastPage() > 1)
    <tr>
        <td colspan="10">
            <div class="pull-right departments-paginator">
                {{$departments->onEachSide(3)->links()}}
            </div>
        </td>
    </tr>
@endif

<script>
	table({
        paginator: '.departments-paginator',
        content: '.departments-content',
        url: '{{route('departments.paginate')}}',
        sort: '.departments-sort',
        form: '.departments-form'
    });

	remover('.delete-department', '.crud-item');
</script>
