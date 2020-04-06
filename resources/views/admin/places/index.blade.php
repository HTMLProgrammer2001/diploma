@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Места стажировки
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Главная</a></li>
                <li><a href="{{route('places.index')}}">Места стажировки</a></li>
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
                        <a href="{{route('places.create')}}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название учреждения</th>
                            <th>Адрес учреждения</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($places as $place)
                            <tr>
                                <td>{{$place->id}}</td>
                                <td>{{$place->name}}</td>
                                <td>{{$place->address}}</td>
                                <td style="display: flex">
                                    <a href="{{route('places.edit', $place->id)}}" class="fa fa-pencil"></a>

                                    <form action="{{route('places.destroy', $place->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <label for="delete_{{$place->id}}" onclick="return confirm('Are you sure?')">
                                            <a class="fa fa-remove"></a>
                                        </label>

                                        <button type="submit" id="delete_{{$place->id}}" class="hidden"></button>
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
