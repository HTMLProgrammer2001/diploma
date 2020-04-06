@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Добавить категорию стажировки
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Главная</a></li>
                <li><a href="{{route('categories.index')}}">Категории стажировок</a></li>
                <li><a href="{{route('categories.create')}}">Добавить</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <form action="{{route('categories.store')}}" method="post">
                @include('admin.errors')
                @csrf

                <div class="box">
                    <div class="box-header with-border">
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Название*</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{url()->previous()}}">
                            <button type="button" class="btn btn-default">Назад</button>
                        </a>

                        <button class="btn btn-success pull-right">Добавить</button>
                    </div>
                    <!-- /.box-footer-->
                </div>
            </form>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
@endsection
