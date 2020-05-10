@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Нагорода
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('honors.index')}}">Нагороди</a></li>
                <li><a href="{{route('honors.show', $honor->id)}}">{{$honor->id}}</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-body container">
                    <div>ID: {{$honor->id}}</div>
                    <div>Викладачу: {{$honor->user->getShortName()}}</div>
                    <div>Назва: {{$honor->title}}</div>
                    <div>Номер нагороди: {{$honor->order}}</div>
                    <div>Статус: {{$honor->active ? 'Дійсна' : 'Не дійсна'}}</div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{url()->previous()}}" class="pull-left">
                        <button type="button" class="btn btn-default">Назад</button>
                    </a>

                    @can('moderate')
                        <a href="{{route('honors.edit', $honor->id)}}" class="pull-right">
                            <button type="button" class="btn btn-warning">Редагувати</button>
                        </a>
                    @endcan
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
@endsection
