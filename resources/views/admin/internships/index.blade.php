@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Стажировки
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Главная</a></li>
                <li><a href="{{route('internships.index')}}">Стажировки</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Листинг сущности</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{route('internships.create')}}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Пользователь</th>
                            <th>Категория</th>
                            <th>Тема</th>
                            <th>Количество часов</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($internships as $internship)
                            <tr>
                                <td>{{$internship->id}}</td>
                                <td>{{$internship->getUserShortName()}}</td>
                                <td>{{$internship->getCategoryName()}}</td>
                                <td>{{$internship->title}}</td>
                                <td>{{$internship->hours}}</td>
                                <td>
                                    <a href="{{route('internships.edit', $internship->id)}}" class="fa fa-pencil"></a>
                                    <form action="{{route('internships.destroy', $internship->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <label for="delete_{{$internship->id}}" onclick="return confirm('Are you sure?')">
                                            <a class="fa fa-remove"></a>
                                        </label>

                                        <button type="submit" id="delete_{{$internship->id}}" class="hidden"></button>
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
