@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Освіти
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('educations.index')}}">Освіти</a></li>
                <li><a href="{{route('educations.show', $education->id)}}">{{$education->id}}</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-body container">
                    <div>ID: {{$education->id}}</div>
                    <div>Викладач: {{$education->user->getShortName()}}</div>
                    <div>Назва закладу: {{$education->institution}}</div>
                    <div>Рік випуску: {{$education->graduate_year}}</div>
                    <div>Кваліфікація: {{$education->qualification}}</div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{url()->previous()}}" class="pull-left">
                        <button type="button" class="btn btn-default">Назад</button>
                    </a>

                    @can('moderate')
                        <a href="{{route('educations.edit', $education->id)}}" class="pull-right">
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
