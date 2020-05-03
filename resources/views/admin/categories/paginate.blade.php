@foreach($categories as $category)
    <tr class="crud-item">
        <td>{{$category->id}}</td>
        <td>{{$category->name}}</td>
        <td style="display: flex">
            @can('moderate')
                <a href="{{route('categories.edit', $category->id)}}" class="fa fa-pencil"></a>

                <a class="fa fa-remove delete-category" data-url="{{route('categories.destroy',
                    $category->id)}}"></a>
            @endcan
        </td>
    </tr>
@endforeach

<tr>
    <td colspan="10">
        <div class="pull-right categories-paginator">
            {{$categories->onEachSide(3)->links()}}
        </div>
    </td>
</tr>

<script>
	paginate('.categories-paginator', '.categories-content', '{{route('categories.paginate')}}', () => {
		remover('.delete-category', '.crud-item');
	});
</script>
