@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Користувачі
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('users.index')}}">Користувачі</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{route('users.create')}}" class="btn btn-success">Додати</a>
                    </div>
                    <table class="custom-table table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ім'я</th>
                            <th>E-mail</th>
                            <th>Аватар</th>
                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody>
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
                                        <a href="{{route('users.edit', $user->id)}}" class="fa fa-pencil"></a>
                                        <form action="{{route('users.destroy', $user->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <label for="delete_{{$user->id}}" onclick="return confirm('Ви впевнені?')">
                                                <a class="fa fa-remove"></a>
                                            </label>

                                            <button type="submit" id="delete_{{$user->id}}" class="hidden"></button>
                                        </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection
