@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Підвищення кваліфікацій
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('internships.index')}}">Підвищення кваліфікацій</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    @can('moderate')
                        <div class="form-group">
                            <a href="{{route('qualifications.create')}}" class="btn btn-success">Додати</a>
                        </div>
                    @endcan
                    <table class="custom-table table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Користувач</th>
                            <th>Статус</th>
                            <th>Дата</th>
                            <th>Дії</th>
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
                                    @can('moderate')
                                        <a href="{{route('qualifications.edit', $qualification->id)}}" class="fa fa-pencil"></a>

                                        <form action="{{route('qualifications.destroy', $qualification->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <label for="delete_{{$qualification->id}}" onclick="return confirm('Ви впевнені?')">
                                                <a class="fa fa-remove"></a>
                                            </label>

                                            <button type="submit" id="delete_{{$qualification->id}}" class="hidden"></button>
                                        </form>
                                    @endcan
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
