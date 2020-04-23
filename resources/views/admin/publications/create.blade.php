@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Додати публікацію
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('publications.index')}}">Публікації</a></li>
                <li><a href="{{route('publications.create')}}">Додати</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <form action="{{route('publications.store')}}" method="post">
                @include('admin.errors')
                @csrf

                <div class="box">
                    <div class="box-header with-border">
                    </div>
                    <div class="box-body">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="title">Назва*</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
                            </div>

                            <div class="form-group">
                                <label for="publisher">Видавець</label>
                                <input type="text" class="form-control" id="publisher" name="publisher"
                                       value="{{old('publisher')}}">
                            </div>

                            <div class="form-group">
                                <label for="url">URL</label>
                                <input type="text" class="form-control" id="url" name="url" value="{{old('url')}}">
                            </div>

                            <div class="form-group">
                                <label for="date_of_publication">Дата виходу</label>

                                <input type="text" class="form-control pull-right calendar"
                                       value="{{old('date_of_publication')}}" name="date_of_publication"
                                       id="date_of_publication" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="authors">Автори*</label>

                                <select class="form-control select2" id="authors" name="authors[]" multiple="multiple"
                                        data-placeholder="Оберіть авторів">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->getShortName()}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="another_authors">Автори не з коледжу</label>
                                <input type="text" class="form-control" id="another_authors" name="another_authors"
                                       value="{{old('another_authors')}}">
                            </div>

                            <div class="form-group">
                                <label for="description">Опис*</label>
                                <textarea name="description" id="description" cols="30" rows="10"></textarea>
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
