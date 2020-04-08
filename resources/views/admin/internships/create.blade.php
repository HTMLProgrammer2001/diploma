@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Добавить стажировку
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Главная</a></li>
                <li><a href="{{route('internships.index')}}">Стажировки</a></li>
                <li><a href="{{route('internships.create')}}">Добавить</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <form action="{{route('internships.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                @include('admin.errors')

                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user">Преподаватель*</label>
                                    <select class="form-control custom-select" id="user" name="user">
                                        <option value="" selected>Нет</option>

                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->getFullName()}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="category">Категория*</label>
                                    <select class="form-control custom-select" id="category" name="category">
                                        <option value="" selected>Нет</option>

                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="place">Место проведения*</label>
                                    <select class="form-control custom-select" id="place" name="place">
                                        <option value="" selected>Нет</option>

                                        @foreach($places as $place)
                                            <option value="{{$place->id}}">{{$place->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="title">Тема стажировки*</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="from">Дата начала стажировки*</label>
                                    <input type="text" class="form-control pull-right calendar" value="{{old('from')}}"
                                           name="from" id="from" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="to">Дата окончания стажировки*</label>
                                    <input type="text" class="form-control pull-right calendar" value="{{old('to')}}"
                                           name="to" id="to" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="code">Код сертификата прохождения практики</label>
                                    <input type="text" class="form-control" id="code" name="code" value="{{old('code')}}">
                                </div>

                                <div class="form-group">
                                    <label for="hours">Количество часов*</label>
                                    <input type="text" class="form-control" id="hours" name="hours" value="{{old('hours')}}">
                                </div>
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
