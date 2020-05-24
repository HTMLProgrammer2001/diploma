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

            <div class="modal" tabindex="-1" role="dialog" id="user-{{$user->id}}">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{$user->getFullName()}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                <tr class="bg-white">
                                    <th scope="col">Поле</th>
                                    <th scope="col">Значение</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white">
                                        <td>ФІО</td>
                                        <td>{{$user->getFullName()}}</td>
                                    </tr>

                                    <tr class="bg-white">
                                        <td>Дата народження</td>
                                        <td>{{to_locale_date($user->birthday)}}</td>
                                    </tr>

                                    <tr class="bg-white">
                                        <td>Освіта викладача</td>
                                        <td>{{$educationRep->getUserString($user->id)}}</td>
                                    </tr>

                                    <tr class="bg-white">
                                        <td>Рік прийняття на роботу</td>
                                        <td>{{$user->hiring_year}}</td>
                                    </tr>

                                    <tr class="bg-white">
                                        <td>Вислуга років на 2020 рік</td>
                                        <td>{{$user->experience}}</td>
                                    </tr>

                                    <tr class="bg-white">
                                        <td>Домашня адреса, телефон, email</td>
                                        <td>{{$user->address}}, {{$user->phone}}, {{$user->email}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

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
