@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Квалификации
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Главная</a></li>
                <li><a href="{{route('internships.index')}}">Квалификации</a></li>
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
                        <a href="{{route('qualifications.create')}}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Пользователь</th>
                            <th>Статус</th>
                            <th>Дата</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($qualifications as $qualification)
                            <tr>
                                <td>{{$qualification->id}}</td>
                                <td>{{$qualification->getUserShortName()}}</td>
                                <td>{{$qualification->name}}</td>
                                <td>{{$qualification->date}}</td>
                                <td>
                                    <a href="{{route('qualifications.edit', $qualification->id)}}" class="fa fa-pencil"></a>
                                    <form action="{{route('qualifications.destroy', $qualification->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <label for="delete_{{$qualification->id}}" onclick="return confirm('Are you sure?')">
                                            <a class="fa fa-remove"></a>
                                        </label>

                                        <button type="submit" id="delete_{{$qualification->id}}" class="hidden"></button>
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
