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
                        <div class="pull-left">
                            <a href="{{route('qualifications.create')}}" class="btn btn-success">Додати</a>
                        </div>

                        <div class="pull-right">
                            <a href="{{route('qualifications.import')}}" class="btn btn-info">Імпорт</a>
                        </div>
                    @endcan

                    <div class="w-100 mb-3 d-flex justify-content-center">
                            <form class="qualifications-form col-lg-8 d-flex flex-column align-items-center">
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

                                    <div class="form-group d-flex flex-column col">
                                        <label for="category">Категорія</label>
                                        <select class="form-control select2" id="category" name="category">
                                            <option value="" selected>Всі</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category}}">{{$category}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row w-100">
                                    <div class="form-group d-flex flex-column col">
                                        <label for="start_date">З</label>

                                        <input type="text" class="form-control pull-right calendar"
                                               value="" name="start_date"
                                               id="start_date" autocomplete="off">
                                    </div>

                                    <div class="form-group d-flex flex-column col">
                                        <label for="end_date">До</label>

                                        <input type="text" class="form-control pull-right calendar"
                                               value="" name="end_date"
                                               id="end_date" autocomplete="off">
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
                                          class="qualifications-sort fa fa-sort-amount-asc opacity-5"></span>
                                </div>
                            </th>
                            <th>
                                <div class="d-flex justify-content-between w-100">
                                    <span>Користувач</span>
                                    <span data-state="0" data-name="sortUser"
                                          class="qualifications-sort fa fa-sort-amount-asc opacity-5"></span>
                                </div>
                            </th>
                            <th>
                                <div class="d-flex justify-content-between w-100">
                                    <span>Категорія</span>
                                    <span data-state="0" data-name="sortCategory"
                                          class="qualifications-sort fa fa-sort-amount-asc opacity-5"></span>
                                </div>
                            </th>
                            <th>
                                <div class="d-flex justify-content-between w-100">
                                    <span>Дата</span>
                                    <span data-state="0" data-name="sortDate"
                                          class="qualifications-sort fa fa-sort-amount-asc opacity-5"></span>
                                </div>
                            </th>
                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody class="qualifications-content">
                            @include('admin.qualifications.paginate')
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
