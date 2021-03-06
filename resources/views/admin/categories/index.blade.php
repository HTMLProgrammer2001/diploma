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

                        <div class="pull-right mb-3">
                            <form class="form-inline categories-form">
                                <input type="text" name="name" class="form-control mr-2"
                                       placeholder="Пошук по назві"/>

                                <button class="btn btn-info">Пошук</button>
                            </form>
                        </div>

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>
                                <div class="d-flex justify-content-between w-100">
                                    <span>ID</span>
                                    <span data-state="0" data-name="sortID"
                                          class="categories-sort fa fa-sort-amount-asc opacity-5"></span>
                                </div>
                            </th>
                            <th>
                                <div class="d-flex justify-content-between w-100">
                                    <span>Назва категорії</span>
                                    <span data-state="0" data-name="sortName"
                                          class="categories-sort fa fa-sort-amount-asc opacity-5"></span>
                                </div>
                            </th>
                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody class="categories-content">
                            @include('admin.categories.paginate')
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
