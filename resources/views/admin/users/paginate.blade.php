@foreach($users as $user)
    <tr>
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

                <form action="{{route('users.destroy', $user->id)}}" method="post">
                    @csrf
                    @method('DELETE')

                    <label for="delete_{{$user->id}}" onclick="return confirm('Ви впевнені?')">
                        <a class="fa fa-remove"></a>
                    </label>

                    <button type="submit" id="delete_{{$user->id}}" class="hidden"></button>
                </form>
        @endcan

    </tr>
@endforeach
