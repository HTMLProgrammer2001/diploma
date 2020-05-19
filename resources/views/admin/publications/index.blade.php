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
                        <div class="form-group pull-left">
                            <a href="{{route('publications.create')}}" class="btn btn-success">Додати</a>
                        </div>

                        <div class="form-group pull-right">
                            <a href="{{route('publications.import')}}" class="btn btn-info">Імпорт</a>
                        </div>
                    @endcan

                    <div class="w-100 mb-3 d-flex justify-content-center">
                            <form class="publications-form col-lg-8 d-flex flex-column align-items-center">
                                <div class="row w-100">
                                    <div class="form-group d-flex flex-column col">
                                        <label for="user">Викладач</label>
                                        <select class="form-control select2" id="user" name="user">
                                            <option value="" selected>Всі</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->getFullName()}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col d-flex flex-column">
                                        <label for="title">Назва публікації</label>
                                        <input type="text" id="title" name="title" class="form-control"
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
                            <th>
                                <div class="d-flex justify-content-between w-100">
                                    <span>ID</span>
                                    <span data-state="0" data-name="sortID"
                                          class="publications-sort fa fa-sort-amount-asc opacity-5"></span>
                                </div>
                            </th>
                            <th>
                                <div class="d-flex justify-content-between w-100">
                                    <span>Назва</span>
                                    <span data-state="0" data-name="sortName"
                                          class="publications-sort fa fa-sort-amount-asc opacity-5"></span>
                                </div>
                            </th>
                            <th>Автори</th>
                            <th>
                                <div class="d-flex justify-content-between w-100">
                                    <span>Дата публікації</span>
                                    <span data-state="0" data-name="sortDate"
                                          class="publications-sort fa fa-sort-amount-asc opacity-5"></span>
                                </div>
                            </th>
                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody class="publications-content">
                            @include('admin.publications.paginate')
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
