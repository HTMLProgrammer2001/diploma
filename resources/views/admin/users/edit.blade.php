@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Редагувати користувачів
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('users.index')}}">Користувачі</a></li>
                <li><a href="{{route('users.edit', $user->id)}}">Редагувати</a></li>
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
                                    <label for="name">Ім'я</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                                </div>

                                <div class="form-group">
                                    <label for="surname">Прізвище</label>
                                    <input type="text" class="form-control" id="surname" name="surname" value="{{$user->surname}}">
                                </div>

                                <div class="form-group">
                                    <label for="patronymic">По-батькові</label>
                                    <input type="text" class="form-control" id="patronymic" name="patronymic"
                                           value="{{$user->patronymic}}">
                                </div>

                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                           value="{{$user->email}}">
                                </div>

                                <div class="form-group">
                                    <label for="department">Дата народження</label>
                                    <input type="text" class="form-control pull-right calendar"
                                           value="{{to_locale_date($user->birthday)}}" name="birthday" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="patronymic">Номер паспорта</label>
                                    <input type="text" class="form-control" id="patronymic" name="passport" value="">
                                </div>

                                <div class="form-group">
                                    <label for="code">Ідентифікаційний код</label>
                                    <input type="text" class="form-control" id="code" name="code" value="">
                                </div>

                                <div class="form-group">
                                    <label for="address">Адреса</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                           value="{{$user->address}}">
                                </div>

                                <div class="form-group">
                                    <label for="phone">Телефон</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                           value="{{$user->phone}}">
                                </div>

                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password">Пароль</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Повторіть пароль</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="department">Відділення</label>
                                    <select class="form-control select2" id="department" name="department"
                                            value="{{$user->getDepartmentID()}}">
                                        <option value="">Немає</option>

                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}"
                                                {{$user->getDepartmentID() == $department->id ? ' selected' : ''}}>{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="commission">Циклова комісія</label>
                                    <select class="form-control select2" id="commission" name="commission">
                                        <option value="">Немає</option>

                                        @foreach($commissions as $commission)
                                            <option value="{{$commission->id}}"
                                                {{$user->getCommissionID() == $commission->id ? ' selected' : ''}}>{{$commission->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="role">Роль</label>
                                    <select class="form-control select2" id="role" name="role">
                                        @foreach($roles as $key => $name)
                                            <option value="{{$key}}"
                                                    {{$user->role == $key ? ' selected' : ''}}>{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="rank">Розряд</label>
                                    <select class="form-control select2" id="rank" name="rank">
                                        <option value="" selected>Немає</option>

                                        @foreach($ranks as $rank)
                                            <option value="{{$rank->id}}"
                                                    {{$user->getRankID() == $rank->id ? 'selected' : ''}}
                                            >{{$rank->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="hiring_year">Рік прийняття на роботу</label>
                                    <input type="number" class="form-control" id="hiring_year"
                                           name="hiring_year" placeholder="" value="{{$user->hiring_year}}">
                                </div>

                                <div class="form-group">
                                    <label for="pedagogical_title">Педагогічне звання</label>
                                    <select class="form-control select2" id="pedagogical_title"
                                            name="pedagogical_title">
                                        <option value="" selected>Немає</option>

                                        @foreach($pedagogicals as $pedagogical)
                                            <option value="{{$pedagogical}}"
                                                    {{$user->pedagogical_title == $pedagogical ? 'selected' : ''}}
                                            >{{$pedagogical}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="experience">Стаж</label>
                                    <input type="number" class="form-control" id="experience"
                                           name="experience" placeholder="Стаж в роках" value="{{$user->experience}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="avatar">Аватар</label>
                            <img src="{{$user->getAvatar()}}" alt="" class="img-responsive" width="150" style="margin: 20px">
                            <input type="file" id="avatar" name="avatar">

                            <p class="help-block">Зображення в форматах jpeg чи png</p>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{url()->previous()}}">
                            <button type="button" class="btn btn-default">Назад</button>
                        </a>

                        <button class="btn btn-warning pull-right">Редагувати</button>
                    </div>
                    <!-- /.box-footer-->
                </div>
            </form>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection
