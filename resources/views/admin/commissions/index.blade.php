@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Комісії
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('commissions.index')}}">Комісії</a></li>
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
                            <a href="{{route('commissions.create')}}" class="btn btn-success">Додати</a>
                        </div>
                    @endcan

                    <div class="pull-right">
                        <form action="{{route('commissions.index')}}" class="form-inline">
                            <input type="text" name="title" class="form-control"
                                   placeholder="Пошук по назві"/>

                            <button class="btn btn-info">Пошук</button>
                        </form>
                    </div>

                    <br/>
                    <br/>
                    <br/>
                    <br/>

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Назва</th>
                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody class="wrap-content"></tbody>
                    </table>

                    <div class="pull-right paginator">
                        {{$commissions->onEachSide(5)->links()}}
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>

    <script>
        $(document).ready(() => {
			getData("{{route('commissions.paginate')}}", 1, '.wrap-content');
        });

        $('.page-link').on('click', (e) => {
        	e.preventDefault();

            //active page click
        	if($(e.target).hasClass('active'))
        		return;

        	//change items in list
        	getData("{{route('commissions.paginate')}}", $(e.target).text(), '.wrap-content');

        	//remove old active item class
        	$(e.target).closest('.paginator').find('.active').toggleClass('active');

        	//add active class to this item
        	$(e.target).closest('.page-item').addClass('active');
        });
    </script>
@endsection
