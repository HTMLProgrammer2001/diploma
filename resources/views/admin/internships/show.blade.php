@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Стажування
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('internships.index')}}">Стажування</a></li>
                <li><a href="{{route('internships.show', $internship->id)}}">{{$internship->id}}</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-body container">
                    <div>ID: {{$internship->id}}</div>

                    @if($internship->title)
                        <div>Тема стажування: {{$internship->title}}</div>
                    @endif

                    <div>
                        <span>Викладач:</span>

                        <a href="{{route('users.show', $internship->user->id)}}">
                            {{$internship->user->getFullName()}}
                        </a>
                    </div>

                    <div>Категорія: {{$internship->category->name}}</div>
                    <div>Місце стажування: {{$internship->place->name}}</div>

                    @if($internship->from)
                        <div>Дата початку стажування: {{$internship->from}}</div>
                    @endif

                    @if($internship->to)
                        <div>Дата кінця стажування: {{$internship->to}}</div>
                    @endif

                    @if($internship->hours)
                        <div>Кількість годин: {{$internship->hours}}</div>
                    @endif

                    @if($internship->code)
                        <div>Код стажування: {{$internship->code}}</div>
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{url()->previous()}}" class="pull-left">
                        <button type="button" class="btn btn-default">Назад</button>
                    </a>

                    @can('moderate')
                        <a href="{{route('internships.edit', $internship->id)}}" class="pull-right">
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
