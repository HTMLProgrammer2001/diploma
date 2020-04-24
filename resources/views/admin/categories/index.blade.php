@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Категорії стажувань
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('categories.index')}}">Категорії стажувань</a></li>
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
                            <a href="{{route('categories.create')}}" class="btn btn-success">Додати</a>
                        </div>
                    @endcan

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Назва категорії</th>
                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody class="wrap-content"></tbody>
                    </table>

                    <div class="pull-right paginator">
                        {{$categories->onEachSide(5)->links()}}
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <script src="/js/categories.js"></script>
        </section>
        <!-- /.content -->
    </div>
@endsection
