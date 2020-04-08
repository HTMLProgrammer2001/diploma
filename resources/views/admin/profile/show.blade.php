@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Профиль пользователя {{$user->getFullName()}}
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Главная</a></li>
                <li><a href="{{route('profile.show')}}">Профиль</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="{{$user->getAvatar()}}" alt="" style="max-width: 100%;">
                            </div>

                            <div class="col-sm-7 col-sm-offset-1">
                                <div>Имя: {{$user->getFullName()}}</div>
                                <div>Дата рождения: {{$user->getBirthdayString()}}</div>
                                <div>Email: {{$user->email}}</div>
                                <div>Роль: {{$user->getRoleString()}}</div>
                                <div>Отделение: {{$user->getDepartmentName()}}</div>
                                <div>Цикловая коммиссия: {{$user->getCommissionName()}}</div>
                            </div>
                        </div>

                        <h3>Публикации</h3>

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Авторы</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->publications as $publication)
                                <tr>
                                    <td>{{$publication->id}}</td>
                                    <td>{{$publication->title}}</td>
                                    <td>{{$publication->getAuthorsString()}}</td>
                                    <td>
                                        <a href="{{route('publications.edit', $publication->id)}}" class="fa fa-pencil"></a>
                                        <form action="{{route('publications.destroy', $publication->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <label for="delete" onclick="return confirm('Are you sure?')">
                                                <a class="fa fa-remove"></a>
                                            </label>

                                            <button type="submit" id="delete" class="hidden"></button>
                                        </form>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <h3>Стажировки</h3>

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Тема</th>
                                <th>Место</th>
                                <th>Дата</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->internships as $internship)
                                <tr>
                                    <td>{{$internship->id}}</td>
                                    <td>{{$internship->title}}</td>
                                    <td>{{$internship->getPlaceName()}}</td>
                                    <td>{{$internship->to}}</td>
                                    <td>
                                        <a href="{{route('internships.edit', $internship->id)}}" class="fa fa-pencil"></a>
                                        <form action="{{route('internships.destroy', $internship->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <label for="delete" onclick="return confirm('Are you sure?')">
                                                <a class="fa fa-remove"></a>
                                            </label>

                                            <button type="submit" id="delete" class="hidden"></button>
                                        </form>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{url()->previous()}}">
                            <button type="button" class="btn btn-default">Назад</button>
                        </a>

                        <a href="{{route('profile.edit')}}">
                            <button class="btn btn-warning pull-right">Изменить</button>
                        </a>
                    </div>
                    <!-- /.box-footer-->
                </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection
