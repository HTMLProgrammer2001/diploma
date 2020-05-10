@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Догана
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('rebukes.index')}}">Догани</a></li>
                <li><a href="{{route('rebukes.show', $rebuke->id)}}">{{$rebuke->id}}</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-body container">
                    <div>ID: {{$rebuke->id}}</div>
                    <div>Викладачу: {{$rebuke->user->getShortName()}}</div>
                    <div>Назва: {{$rebuke->title}}</div>
                    <div>Номер догани: {{$rebuke->order}}</div>
                    <div>Статус: {{$rebuke->active ? 'Дійсна' : 'Не дійсна'}}</div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{url()->previous()}}" class="pull-left">
                        <button type="button" class="btn btn-default">Назад</button>
                    </a>

                    @can('moderate')
                        <a href="{{route('rebukes.edit', $rebuke->id)}}" class="pull-right">
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
