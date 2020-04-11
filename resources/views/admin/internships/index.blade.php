@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Стажування
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('internships.index')}}">Стажування</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{route('internships.create')}}" class="btn btn-success">Додати</a>
                    </div>
                    <table class="custom-table table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Користувач</th>
                            <th>Категорія</th>
                            <th>Тема</th>
                            <th>Кількість годин</th>
                            <th>Дії</th>
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
                                        <label for="delete_{{$internship->id}}" onclick="return confirm('Ви впевнені?')">
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
