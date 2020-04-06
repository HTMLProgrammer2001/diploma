@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Редактировать категорию стажировки
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Главная</a></li>
                <li><a href="{{route('categories.index')}}">Места стажировки</a></li>
                <li><a href="{{route('categories.edit', $category->id)}}">Редактировать</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <form action="{{route('categories.update', $category->id)}}" method="post">
                @include('admin.errors')
                @csrf
                @method('PUT')

                <div class="box">
                    <div class="box-header with-border">
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Название*</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{url()->previous()}}">
                            <button type="button" class="btn btn-default">Назад</button>
                        </a>

                        <button class="btn btn-warning pull-right">Изменить</button>
                    </div>
                    <!-- /.box-footer-->
                </div>
            </form>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
@endsection
