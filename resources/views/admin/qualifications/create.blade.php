@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Добавить квалификацию
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Главная</a></li>
                <li><a href="{{route('qualifications.index')}}">Квалификации</a></li>
                <li><a href="{{route('qualifications.create')}}">Добавить</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <form action="{{route('qualifications.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                @include('admin.errors')

                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
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
                                    <label for="name">Квалификация*</label>
                                    <select class="form-control custom-select" id="name" name="name">
                                        <option value="">Нет</option>

                                        @foreach($qualificationNames as $qualificationName)
                                            <option value="{{$qualificationName}}">{{$qualificationName}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="date">Дата квалификации*</label>
                                    <input type="text" class="form-control pull-right calendar" value="{{old('date')}}"
                                           name="date" id="date" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="description">Описание</label>
                                    <textarea name="description" id="description" cols="30" rows="10"></textarea>
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
