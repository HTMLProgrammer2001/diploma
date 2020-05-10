@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Публікація
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('publications.index')}}">Публікації</a></li>
                <li><a href="{{route('publications.show', $publication->id)}}">{{$publication->id}}</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-body container">
                    <div>ID: {{$publication->id}}</div>
                    <div>Назва: {{$publication->title}}</div>
                    <div>Дата публікації: {{$publication->date_of_publication}}</div>
                    <div>
                        <span>Автори:</span>

                        @foreach($publication->authors as $author)
                            <a href="{{route('users.show', $author)}}">{{$author->getShortName()}},</a>
                        @endforeach

                        <span>{{$publication->another_authors}}</span>
                    </div>

                    @if($publication->url)
                        <div>URL публікації: {{$publication->url}}</div>
                    @endif

                    @if($publication->publisher)
                        <div>Видавець: {{$publication->publisher}}</div>
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{url()->previous()}}" class="pull-left">
                        <button type="button" class="btn btn-default">Назад</button>
                    </a>

                    @can('moderate')
                        <a href="{{route('publications.edit', $publication->id)}}" class="pull-right">
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
