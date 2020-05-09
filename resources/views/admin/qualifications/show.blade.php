@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Підвищення категорії</h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('qualifications.index')}}">Підвищення категорії</a></li>
                <li><a href="{{route('qualifications.show', $qualification->id)}}">{{$qualification->id}}</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-body container">
                    <div>ID: {{$qualification->id}}</div>
                    <div>Викладач: {{$qualification->user->getShortName()}}</div>
                    <div>Назва: {{$qualification->name}}</div>
                    <div>Дата встановлення: {{$qualification->date}}</div>

                    <br>

                    @if($qualification->description)
                        <div>Опис: {{$qualification->description}}</div>
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{url()->previous()}}">
                        <button type="button" class="btn btn-default">Назад</button>
                    </a>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
@endsection
