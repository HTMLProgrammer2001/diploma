@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Додати користувача
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('users.index')}}">Користувачі</a></li>
                <li><a href="{{route('users.create')}}">Додати</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                @include('admin.errors')

                <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Ім'я*</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                            </div>

                            <div class="form-group">
                                <label for="surname">Прізвище*</label>
                                <input type="text" class="form-control" id="surname" name="surname" value="{{old('surname')}}">
                            </div>

                            <div class="form-group">
                                <label for="patronymic">По-батькові*</label>
                                <input type="text" class="form-control" id="patronymic" name="patronymic" value="{{old('patronymic')}}">
                            </div>

                            <div class="form-group">
                                <label for="email">E-mail*</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}">
                            </div>

                            <div class="form-group">
                                <label for="password">Пароль*</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Повторіть пароль*</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="avatar">Аватар</label>
                                <input type="file" id="avatar" name="avatar">

                                <p class="help-block">Зображення в форматах jpeg чи png</p>
                            </div>

                            <div class="form-group">
                                <label for="department">Відділення</label>
                                <select class="form-control  select2" id=department" name="department" value="{{old('department')}}">
                                    <option value="" selected>Немає</option>

                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="commission">Циклова комісія</label>
                                <select class="form-control select2" id=commission" name="commission" value="{{old('commission')}}">
                                    <option value="" selected>Немає</option>

                                    @foreach($commissions as $commission)
                                        <option value="{{$commission->id}}">{{$commission->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="birthday">Дата народження</label>
                                <input type="text" class="form-control pull-right calendar"
                                       value="{{old('birthday')}}" name="birthday" id="birthday" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="patronymic">Номер паспорта</label>
                                <input type="text" class="form-control" id="patronymic"
                                       name="passport" value="{{old('passport')}}">
                            </div>

                            <div class="form-group">
                                <label for="patronymic">Ідентифікаційний код</label>
                                <input type="text" class="form-control" id="patronymic"
                                       name="code" value="{{old('code')}}">
                            </div>

                            <div class="form-group">
                                <label for="rank">Розряд</label>
                                <select class="form-control select2" id="rank" name="rank" value="{{old('rank')}}">
                                    <option value="" selected>Немає</option>

                                    @foreach($ranks as $rank)
                                        <option value="{{$rank->id}}">{{$rank->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{url()->previous()}}">
                        <button type="button" class="btn btn-default">Назад</button>
                    </a>

                    <button class="btn btn-success pull-right">Додати</button>
                </div>
                <!-- /.box-footer-->
                </div>
            </form>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection
