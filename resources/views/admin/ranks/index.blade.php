@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Розряди
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('ranks.index')}}">Розряди</a></li>
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
                            <a href="{{route('ranks.create')}}" class="btn btn-success">Додати</a>
                        </div>
                    @endcan

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Назва розряду</th>
                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody class="wrap-content"></tbody>
                    </table>

                    <div class="pull-right paginator">
                        {{$ranks->onEachSide(5)->links()}}
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <script src="/js/pagination.js"></script>
            <script src="/js/remover.js"></script>
            <script>
				paginate('.paginator', '.wrap-content', '{{route('ranks.paginate')}}', () => {
					remover('.deleteItem', '.crud-item');
				});
            </script>
        </section>
        <!-- /.content -->
    </div>
@endsection
