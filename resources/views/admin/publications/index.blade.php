@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Публікації
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('publications.index')}}">Публікації</a></li>
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
                            <a href="{{route('publications.create')}}" class="btn btn-success">Додати</a>
                        </div>
                    @endcan

                    <table class="custom-table table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Назва</th>
                            <th>Автори</th>
                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($publications as $publication)
                            <tr>
                                <td>{{$publication->id}}</td>
                                <td>{{$publication->title}}</td>
                                <td>{{$publication->getAuthorsString()}}</td>
                                <td style="display: flex">

                                    @can('moderate')
                                        <a href="{{route('publications.edit', $publication->id)}}" class="fa fa-pencil"></a>

                                        <form action="{{route('publications.destroy', $publication->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <label for="delete_{{$publication->id}}" onclick="return confirm('Ви впевнені?')">
                                                <a class="fa fa-remove"></a>
                                            </label>

                                            <button type="submit" id="delete_{{$publication->id}}" class="hidden"></button>
                                        </form>
                                    @endcan

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
