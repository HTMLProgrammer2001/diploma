@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Редагувати посаду
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('ranks.index')}}">Посади</a></li>
                <li><a href="{{route('ranks.edit', $rank->id)}}">Редагувати</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <form action="{{route('ranks.update', $rank->id)}}" method="post">
                @include('admin.errors')
                @csrf
                @method('PUT')

                <div class="box">
                    <div class="box-header with-border">
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Назва*</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$rank->name}}">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{url()->previous()}}">
                            <button type="button" class="btn btn-default">Назад</button>
                        </a>

                        <button class="btn btn-warning pull-right">Редагувати</button>
                    </div>
                    <!-- /.box-footer-->
                </div>
            </form>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
@endsection
