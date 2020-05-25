@foreach($users as $user)
    <tr class="crud-item">
        <td>{{$user->id}}</td>
        <td>{{$user->getFullName()}}</td>
        <td>{{$user->email}}</td>
        <td>
            <img src="{{$user->getAvatar()}}" alt="" class="img-responsive" width="150">
        </td>
        <td>
            <a href="{{route('users.show', $user->id)}}" class="fa fa-eye"></a>
            <a href="#user-{{$user->id}}" data-toggle="modal" class="fa fa-eye"></a>

            @include('admin.users.modal')

            @can('moderate')
                <a href="{{route('users.edit', $user->id)}}" class="fa fa-pencil"></a>

                <a href="#" class="fa fa-remove user-delete" data-url="{{route('users.destroy', $user->id)}}"></a>
        @endcan
    </tr>
@endforeach

@if($users->lastPage() > 1)
    <tr>
        <td colspan="5">
            <div class="pull-right user-paginator">
                {{$users->onEachSide(3)->links()}}
            </div>
        </td>
    </tr>
@endif

<script>
	table({
        paginator: '.user-paginator',
        content: '.user-content',
        form: '.user-form',
        sort: '.users-sort',
        url: '{{route('users.paginate')}}'
    });

	remover('.user-delete', '.crud-item');
</script>
