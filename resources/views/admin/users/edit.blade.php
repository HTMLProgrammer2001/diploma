@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Изменить пользователя
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Главная</a></li>
                <li><a href="{{route('departments.index')}}">Пользователи</a></li>
                <li><a href="{{route('departments.create')}}">Изменить</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <form action="{{route('users.update', $user->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.errors')

                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                            </div>

                            <div class="form-group">
                                <label for="surname">Фамилия</label>
                                <input type="text" class="form-control" id="surname" name="surname" value="{{$user->surname}}">
                            </div>

                            <div class="form-group">
                                <label for="patronymic">Отчество</label>
                                <input type="text" class="form-control" id="patronymic" name="patronymic" value="{{$user->patronymic}}">
                            </div>

                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}">
                            </div>

                            <div class="form-group">
                                <label for="password">Пароль</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Подтвердите пароль</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="">
                            </div>
                            </div>

                            <div class="col-md-6">

                            <div class="form-group">
                                <label for="department">Отделение</label>
                                <select class="form-control select2" id="department" name="department" value="{{$user->getDepartmentID()}}">
                                    <option value="">Нет</option>

                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}"
                                                {{$user->getDepartmentID() == $department->id ? ' selected' : ''}}>{{$department->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="commission">Цикловая коммиссия</label>
                                <select class="form-control select2" id="commission" name="commission">
                                    <option value="">Нет</option>

                                    @foreach($commissions as $commission)
                                        <option value="{{$commission->id}}"
                                                {{$user->getCommissionID() == $commission->id ? ' selected' : ''}}>{{$commission->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                                <div class="form-group">
                                    <label for="department">Дата рождения</label>
                                    <input type="text" class="form-control pull-right" value="{{$user->birthday}}" name="birthday" id="calendar" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="patronymic">Номер паспорта</label>
                                    <input type="text" class="form-control" id="patronymic" name="passport" value="">
                                </div>

                                <div class="form-group">
                                    <label for="patronymic">Идентификационный код</label>
                                    <input type="text" class="form-control" id="patronymic" name="code" value="">
                                </div>

                                <div class="form-group">
                                    <label for="role">Роль</label>
                                    <select class="form-control select2" id="role" name="role">
                                        <option value="{{App\User::ROLE_USER}}"
                                                {{$user->role == App\User::ROLE_USER ? ' selected' : ''}}>Пользователь</option>

                                        <option value="{{App\User::ROLE_COMMISSION_DIRECTORY}}"
                                                {{$user->role == App\User::ROLE_COMMISSION_DIRECTORY ? ' selected' : ''}}>Глава цикловой коммиссии</option>

                                        <option value="{{App\User::ROLE_DEPARTMENT_DIRECTORY}}"
                                                {{$user->role == App\User::ROLE_DEPARTMENT_DIRECTORY ? ' selected' : ''}}>Глава отделения</option>

                                        <option value="{{App\User::ROLE_MODERATOR}}"
                                                {{$user->role == App\User::ROLE_MODERATOR ? ' selected' : ''}}>Модератор</option>

                                        <option value="{{App\User::ROLE_ADMIN}}"
                                                {{$user->role == App\User::ROLE_ADMIN ? ' selected' : ''}}>Администратор</option>
                                    </select>
                                </div>
                        </div>
                        </div>

                        <div class="form-group">
                            <label for="avatar">Аватар</label>
                            <img src="{{$user->getAvatar()}}" alt="" class="img-responsive" width="150" style="margin: 20px">
                            <input type="file" id="avatar" name="avatar">

                            <p class="help-block">Изображения в форматах jpeg или png</p>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{url()->previous()}}">
                            <button type="button" class="btn btn-default">Назад</button>
                        </a>

                        <button class="btn btn-warning pull-right">Изменить</button>
                    </div>
                    <!-- /.box-footer-->
                </div>
            </form>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection
