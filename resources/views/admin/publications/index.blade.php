@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Публикации
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Главная</a></li>
                <li><a href="{{route('publications.index')}}">Публикации</a></li>
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
                        <a href="{{route('publications.create')}}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Авторы</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($publications as $publication)
                            <tr>
                                <td>{{$publication->id}}</td>
                                <td>{{$publication->title}}</td>
                                <td>{{$publication->getAuthorsString()}}</td>
                                <td style="display: flex">
                                    <a href="{{route('publications.edit', $publication->id)}}" class="fa fa-pencil"></a>

                                    <form action="{{route('publications.destroy', $publication->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <label for="delete_{{$publication->id}}" onclick="return confirm('Are you sure?')">
                                            <a class="fa fa-remove"></a>
                                        </label>

                                        <button type="submit" id="delete_{{$publication->id}}" class="hidden"></button>
                                    </form>
                                </td>
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
