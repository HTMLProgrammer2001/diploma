@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Користувачі
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('users.index')}}">Користувачі</a></li>
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
                            <a href="{{route('users.create')}}" class="btn btn-success">Додати</a>
                        </div>
                    @endcan

                        <div class="w-100 mb-3 d-flex justify-content-center">
                            <form class="user-form col-lg-8 d-flex flex-column align-items-center">
                                <div class="row w-100">
                                    <div class="form-group col d-flex flex-column">
                                        <label for="name">Ім'я</label>
                                        <input type="name" id="name" name="name" class="form-control"
                                               placeholder="Назва публікації"/>
                                    </div>
                                </div>

                                <div class="row w-100">
                                    <div class="form-group d-flex flex-column col">
                                        <label for="start_date_of_publication">З</label>

                                        <input type="text" class="form-control pull-right calendar"
                                               value="" name="start_date_of_publication"
                                               id="start_date_of_publication" autocomplete="off">
                                    </div>

                                    <div class="form-group d-flex flex-column col">
                                        <label for="end_date_of_publication">До</label>

                                        <input type="text" class="form-control pull-right calendar"
                                               value="" name="end_date_of_publication"
                                               id="end_date_of_publication" autocomplete="off">
                                    </div>
                                </div>


                                <button class="btn btn-info w-50">Пошук</button>
                            </form>
                        </div>

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ім'я</th>
                            <th>E-mail</th>
                            <th>Аватар</th>
                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody class="user-content">
                            @include('admin.users.paginate')
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
