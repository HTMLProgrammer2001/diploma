@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Додати освіту
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('educations.index')}}">Освіти</a></li>
                <li><a href="{{route('educations.create')}}">Додати</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <form action="{{route('educations.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                @include('admin.errors')

                <div class="box">
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user">Викладач*</label>
                                <select class="form-control select2" id="user" name="user">
                                    <option value="" selected>Немає</option>

                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->getFullName()}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="institution">Назва закладу*</label>
                                <input type="text" class="form-control" id="institution" name="institution"
                                       value="{{old('institution')}}">
                            </div>

                            <div class="form-group">
                                <label for="user">Кваліфікація*</label>
                                <select class="form-control select2" id="qualification" name="qualification">
                                    @foreach($qualifications as $qualification)
                                        <option value="{{$qualification}}">{{$qualification}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="graduate_year">Рік випуску*</label>
                                <input type="number" class="form-control"
                                       value="{{old('graduate_year')}}"
                                       name="graduate_year" id="graduate_year" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{url()->previous()}}">
                            <button type="button" class="btn btn-default">Назад</button>
                        </a>

                        <button class="btn btn-success pull-right">Додати</button>
                    </div>
                    <!-- /.box-footer-->
                </div>
            </form>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection
