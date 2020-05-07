@foreach($categories as $category)
    <tr class="crud-item">
        <td>{{$category->id}}</td>
        <td>{{$category->name}}</td>
        <td class="d-flex">
            @can('moderate')
                <a href="{{route('categories.edit', $category->id)}}" class="fa fa-pencil"></a>

                <a href="#" class="fa fa-remove delete-category" data-url="{{route('categories.destroy',
                    $category->id)}}"></a>
            @endcan
        </td>
    </tr>
@endforeach

@if($categories->total() > 1)
    <tr>
        <td colspan="10">
            <div class="pull-right categories-paginator">
                {{$categories->onEachSide(3)->links()}}
            </div>
        </td>
    </tr>
@endif

<script>
	paginate({
        paginator: '.categories-paginator',
        content: '.categories-content',
        url: '{{route('categories.paginate')}}',
        form: '.categories-form'
    });

    remover('.delete-category', '.crud-item');
</script>
