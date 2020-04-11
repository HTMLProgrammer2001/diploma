@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Додати стажування
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('internships.index')}}">Стажування</a></li>
                <li><a href="{{route('internships.create')}}">Додати</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <form action="{{route('internships.store')}}" method="post" enctype="multipart/form-data">
                @csrf

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
                                            <option value="{{$user->id}}">{{$user->getFullName()}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="category">Категорія*</label>
                                    <select class="form-control select2" id="category" name="category">
                                        <option value="" selected>Немає</option>

                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="place">Місце проведення*</label>
                                    <select class="form-control select2" id="place" name="place">
                                        <option value="" selected>Немає</option>

                                        @foreach($places as $place)
                                            <option value="{{$place->id}}">{{$place->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="title">Тема стажування*</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="from">Дата початку стажування*</label>
                                    <input type="text" class="form-control pull-right calendar" value="{{old('from')}}"
                                           name="from" id="from" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="to">Дата кінця стажування*</label>
                                    <input type="text" class="form-control pull-right calendar" value="{{old('to')}}"
                                           name="to" id="to" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="code">Код сертифіката проходження стажування</label>
                                    <input type="text" class="form-control" id="code" name="code" value="{{old('code')}}">
                                </div>

                                <div class="form-group">
                                    <label for="hours">Кількість годин*</label>
                                    <input type="text" class="form-control" id="hours" name="hours" value="{{old('hours')}}">
                                </div>
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
