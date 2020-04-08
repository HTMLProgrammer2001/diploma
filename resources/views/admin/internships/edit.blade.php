@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Редактировать стажировку
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Главная</a></li>
                <li><a href="{{route('internships.index')}}">Стажировки</a></li>
                <li><a href="{{route('internships.edit', $internship->id)}}">Редактировать</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <form action="{{route('internships.update', $internship->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.errors')

                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user">Преподаватель*</label>
                                    <select class="form-control custom-select" name="user">
                                        <option value="" selected>Нет</option>

                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" {{$internship->getUserID() == $user->id ? ' selected' : ''}}>
                                                {{$user->getFullName()}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="category">Категория*</label>
                                    <select class="form-control custom-select" id="category" name="category">
                                        <option value="" selected>Нет</option>

                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{$internship->getCategoryID() == $category->id ? ' selected' : ''}}>
                                                {{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="place">Место проведения*</label>
                                    <select class="form-control custom-select" id="place" name="place">
                                        <option value="" selected>Нет</option>

                                        @foreach($places as $place)
                                            <option value="{{$place->id}}" {{$internship->getPlaceID() == $place->id ? ' selected' : ''}}>
                                                {{$place->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="title">Тема стажировки*</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{$internship->title}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="from">Дата начала стажировки*</label>
                                    <input type="text" class="form-control pull-right calendar" value="{{$internship->from}}"
                                           name="from" id="from" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="to">Дата окончания стажировки*</label>
                                    <input type="text" class="form-control pull-right calendar" value="{{$internship->to}}"
                                           name="to" id="to" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="code">Код сертификата прохождения практики</label>
                                    <input type="text" class="form-control" id="code" name="code" value="{{$internship->code}}">
                                </div>

                                <div class="form-group">
                                    <label for="hours">Количество часов*</label>
                                    <input type="text" class="form-control" id="hours" name="hours" value="{{$internship->hours}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{url()->previous()}}">
                            <button type="button" class="btn btn-default">Назад</button>
                        </a>

                        <button class="btn btn-success pull-right">Изменить</button>
                    </div>
                    <!-- /.box-footer-->
                </div>
            </form>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection
