@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Догани
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('rebukes.index')}}">Догани</a></li>
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
                            <a href="{{route('rebukes.create')}}" class="btn btn-success">Додати</a>
                        </div>

                        <div class="form-group pull-right">
                            <a href="{{route('rebukes.import')}}" class="btn btn-info">Імпорт</a>
                        </div>
                    @endcan

                        <div class="w-100 mb-3 d-flex justify-content-center">
                            <form class="rebukes-form col-lg-8 d-flex flex-column align-items-center">
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
                                        <label for="name">Назва догани</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Назва закладу"/>
                                    </div>
                                </div>

                                <div class="row w-100">
                                    <div class="form-group d-flex flex-column col">
                                        <label for="start_date_presentation">З</label>

                                        <input type="text" class="form-control pull-right calendar"
                                               value="" name="start_date_presentation"
                                               id="start_date_presentation" autocomplete="off">
                                    </div>

                                    <div class="form-group d-flex flex-column col">
                                        <label for="end_date_presentation">До</label>

                                        <input type="text" class="form-control pull-right calendar"
                                               value="" name="end_date_presentation"
                                               id="end_date_presentation" autocomplete="off">
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
                                          class="rebukes-sort fa fa-sort-amount-asc opacity-5"></span>
                                </div>
                            </th>
                            <th>
                                <div class="d-flex justify-content-between w-100">
                                    <span>Викладач</span>
                                    <span data-state="0" data-name="sortUser"
                                          class="rebukes-sort fa fa-sort-amount-asc opacity-5"></span>
                                </div>
                            </th>
                            <th>
                                <div class="d-flex justify-content-between w-100">
                                    <span>Назва догани</span>
                                    <span data-state="0" data-name="sortName"
                                          class="rebukes-sort fa fa-sort-amount-asc opacity-5"></span>
                                </div>
                            </th>
                            <th>
                                <div class="d-flex justify-content-between w-100">
                                    <span>Дата отримання</span>
                                    <span data-state="0" data-name="sortDate"
                                          class="rebukes-sort fa fa-sort-amount-asc opacity-5"></span>
                                </div>
                            </th>

                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody class="rebukes-content">
                            @include('admin.rebukes.paginate')
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
