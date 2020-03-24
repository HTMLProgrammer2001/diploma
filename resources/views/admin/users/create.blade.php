@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Добавить пользователя
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <form action="{{route('users.store')}}" method="post">
                @csrf

                @include('admin.errors')

                <div class="box">
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Имя*</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                        </div>

                        <div class="form-group">
                            <label for="surname">Фамилия*</label>
                            <input type="text" class="form-control" id="surname" name="surname" value="{{old('surname')}}">
                        </div>

                        <div class="form-group">
                            <label for="patronymic">Отчество*</label>
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
                            <label for="password_confirmation">Подтвердите пароль*</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="ava">Аватар</label>
                            <input type="file" id="ava" name="ava">

                            <p class="help-block">Изображения в форматах jpeg или png</p>
                        </div>

                        <div class="form-group">
                            <label for="department">Отделение</label>
                            <select class="form-control custom-select" id=department" name="department" value="{{old('department')}}">
                                <option value="" selected>Нет</option>

                                @foreach($departments as $department)
                                    <option value="{{$department->id}}" selected>{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="commission">Цикловая коммиссия</label>
                            <select class="form-control custom-select" id=commission" name="commission" value="{{old('commission')}}">
                                <option value="" selected>Нет</option>

                                @foreach($commissions as $commission)
                                    <option value="{{$commission->id}}" selected>{{$commission->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{url()->previous()}}">
                        <button type="button" class="btn btn-default">Назад</button>
                    </a>

                    <button class="btn btn-success pull-right">Добавить</button>
                </div>
                <!-- /.box-footer-->
                </div>
            </form>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection
