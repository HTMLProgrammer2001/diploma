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

                    @can('moderate')
                        <div class="form-group">
                            <a href="{{route('places.create')}}" class="btn btn-success">Додати</a>
                        </div>
                    @endcan

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Назва закладу</th>
                            <th>Адреса закладу</th>
                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody class="places-content">
                            @include('admin.places.paginate')
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
