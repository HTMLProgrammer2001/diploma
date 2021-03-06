@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Редагувати профіль
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('profile.show')}}">Профіль</a></li>
                <li><a href="{{route('profile.edit')}}">Редагувати</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.errors')

                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                           value="{{$user->email}}">
                                </div>

                                <div class="form-group">
                                    <label for="password">Пароль</label>
                                    <input type="password" class="form-control" id="password"
                                           name="password" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Повторіть пароль</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                           name="password_confirmation" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="phone">Телефон</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" pattern="^+38\d{10}$"
                                           value="{{$user->phone}}">
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="department">Дата народження</label>
                                    <input type="text" class="form-control pull-right calendar"
                                           value="{{to_locale_date($user->birthday)}}" name="birthday"
                                           id="calendar" autocomplete="off">
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
                                    <input type="text" class="form-control" id="address"
                                           name="address" value="{{$user->address}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="avatar">Аватар</label>
                            <img src="{{$user->getAvatar()}}" alt="" class="img-responsive" width="150" style="margin: 20px">
                            <input type="file" id="avatar" name="avatar">

                            <p class="help-block">Зображеняя в форматах jpeg чи png</p>
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
