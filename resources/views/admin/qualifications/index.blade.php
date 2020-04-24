@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Встановлення категорій
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('internships.index')}}">Встановлення категорій</a></li>
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
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Користувач</th>
                            <th>Статус</th>
                            <th>Дата</th>
                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody class="wrap-content"></tbody>
                    </table>
                </div>

                <div class="pull-right paginator">
                    {{$qualifications->onEachSide(5)->links()}}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <script src="/js/qualifications.js"></script>
        </section>
        <!-- /.content -->
    </div>
@endsection
