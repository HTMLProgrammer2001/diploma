@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Освіта
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('educations.index')}}">Освіта</a></li>
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
                            <a href="{{route('educations.create')}}" class="btn btn-success">Додати</a>
                        </div>
                    @endcan

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Викладач</th>
                            <th>Заклад освіти</th>
                            <th>Рік випуску</th>
                            <th>Кваліфікація</th>
                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody class="wrap-content"></tbody>
                    </table>

                        <div class="pull-right paginator">
                            {{$educations->onEachSide(5)->links()}}
                        </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <script src="/js/pagination.js"></script>
            <script src="/js/remover.js"></script>
            <script>
				paginate('.paginator', '.wrap-content', '{{route('educations.paginate')}}', () => {
					remover('.deleteItem', '.crud-item');
				});
            </script>
        </section>
        <!-- /.content -->
    </div>
@endsection
