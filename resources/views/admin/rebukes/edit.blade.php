@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Редагувати догану
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('rebukes.index')}}">Догани</a></li>
                <li><a href="{{route('rebukes.edit', $rebuke->id)}}">Редагувати</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <form action="{{route('rebukes.update', $rebuke->id)}}" method="post" enctype="multipart/form-data">
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
                                                    {{$user->id == $rebuke->getUserID() ? 'selected' : ''}}
                                            >{{$user->getFullName()}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="title">Назва догани*</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                           value="{{$rebuke->title}}">
                                </div>

                                <div class="form-group">
                                    <label for="order">Номер догани*</label>
                                    <input type="text" class="form-control" id="order" name="order"
                                           value="{{$rebuke->order}}">
                                </div>

                                <div class="form-group">
                                    <label for="date_presentation">Дата отримання*</label>
                                    <input type="text" class="form-control pull-right calendar"
                                           value="{{$rebuke->date_presentation}}"
                                           name="date_presentation" id="date_presentation" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="is_active">Дійсний статус*</label>
                                    <input type="checkbox" class="checkbox"
                                           {{$rebuke->active ? 'checked' : ''}}
                                           name="active" id="active" autocomplete="off">
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
