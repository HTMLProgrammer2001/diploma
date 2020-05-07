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

                    <div class="w-100 mb-3 d-flex justify-content-center">
                        <form class="educations-form col-lg-8 d-flex flex-column align-items-center">
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
                                    <label for="qualification">Кваліфікація</label>
                                    <select class="form-control select2" id="qualification" name="qualification">
                                        <option value="">Всі</option>
                                        @foreach($qualifications as $qualification)
                                            <option value="{{$qualification}}">{{$qualification}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row w-100">
                                <div class="form-group col d-flex flex-column">
                                    <label for="name">Назва закладу</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                           placeholder="Назва закладу"/>
                                </div>

                                <div class="form-group col d-flex flex-column">
                                    <label for="graduate_year">Рік випуску</label>
                                    <input type="number" id="graduate_year" name="graduate_year"
                                           class="form-control" placeholder="Рік випуску"/>
                                </div>
                            </div>


                            <button class="btn btn-info w-50">Пошук</button>
                        </form>
                    </div>

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
                        <tbody class="educations-content">
                            @include('admin.educations.paginate')
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
