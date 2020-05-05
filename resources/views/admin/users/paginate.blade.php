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

            @can('moderate')
                <a href="{{route('users.edit', $user->id)}}" class="fa fa-pencil"></a>

                <a class="fa fa-remove user-delete" data-url="{{route('users.destroy', $user->id)}}"></a>
        @endcan
    </tr>
@endforeach

<tr>
    <td colspan="5">
        <div class="pull-right user-paginator">
            {{$users->onEachSide(3)->links()}}
        </div>
    </td>
</tr>

<script>
	paginate('.user-paginator', '.user-content', '{{route('users.paginate')}}');

	remover('.user-delete', '.crud-item');
</script>
