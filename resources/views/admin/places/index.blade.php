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
                        <div class="d-flex justify-content-between">
                            <div class="form-group">
                                <a href="{{route('places.create')}}" class="btn btn-success">Додати</a>
                            </div>

                            <div class="form-group">
                                <a href="{{route('places.import')}}" class="btn btn-info">Імпорт</a>
                            </div>
                        </div>
                    @endcan

                        <div class="d-flex justify-content-end my-3">
                            <form class="form-inline places-form">
                                <input type="text" name="name" class="form-control mr-2"
                                       placeholder="Пошук по назві закладу"/>

                                <input type="text" name="address" class="form-control mr-2"
                                       placeholder="Пошук по адресі"/>

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
                                          class="places-sort fa fa-sort-amount-asc opacity-5"></span>
                                </div>
                            </th>
                            <th>
                                <div class="d-flex justify-content-between w-100">
                                    <span>Назва закладу</span>
                                    <span data-state="0" data-name="sortName"
                                          class="places-sort fa fa-sort-amount-asc opacity-5"></span>
                                </div>
                            </th>
                            <th>
                                <div class="d-flex justify-content-between w-100">
                                    <span>Адреса</span>
                                    <span data-state="0" data-name="sortAddress"
                                          class="places-sort fa fa-sort-amount-asc opacity-5"></span>
                                </div>
                            </th>
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
