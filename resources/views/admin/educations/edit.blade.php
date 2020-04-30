@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Редагувати освіту
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('educations.index')}}">Освіти</a></li>
                <li><a href="{{route('educations.edit', $education->id)}}">Редагувати</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <form action="{{route('educations.update', $education->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.errors')

                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user">Викладач*</label>
                                    <select class="form-control select2" id="user" name="user">
                                        <option value="" selected>Немає</option>

                                        @foreach($users as $user)
                                            <option value="{{$user->id}}"
                                                    {{$user->id == $education->getUserID() ? 'selected' : ''}}
                                            >{{$user->getFullName()}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="institution">Назва закладу*</label>
                                    <input type="text" class="form-control" id="institution" name="institution"
                                           value="{{$education->institution}}">
                                </div>

                                <div class="form-group">
                                    <label for="user">Кваліфікація*</label>
                                    <select class="form-control select2" id="qualification" name="qualification">
                                        @foreach(\App\Education::QUALIFICATIONS as $qualification)
                                            <option value="{{$qualification}}">{{$qualification}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="graduate_year">Рік випуску*</label>
                                    <input type="text" class="form-control"
                                           value="{{$education->graduate_year}}"
                                           name="graduate_year" id="graduate_year" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{url()->previous()}}">
                            <button type="button" class="btn btn-default">Назад</button>
                        </a>

                        <button class="btn btn-success pull-right">Редагувати</button>
                    </div>
                    <!-- /.box-footer-->
                </div>
            </form>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection
