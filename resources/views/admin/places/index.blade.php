@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Місця стажування
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('places.index')}}">Місця стажування</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{route('places.create')}}" class="btn btn-success">Додати</a>
                    </div>
                    <table class="custom-table table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Назва закладу</th>
                            <th>Адреса закладу</th>
                            <th>Дії</th>
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
                                        <label for="delete_{{$place->id}}" onclick="return confirm('Ви впевнені?')">
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
