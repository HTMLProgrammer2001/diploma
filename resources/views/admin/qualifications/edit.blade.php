@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Редагувати встановлення категорії
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('qualifications.index')}}">Встановлення категорій</a></li>
                <li><a href="{{route('qualifications.edit', $qualification->id)}}">Редагувати</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <form action="{{route('qualifications.update', $qualification->id)}}" method="post">
                @include('admin.errors')
                @csrf
                @method('PUT')

                <div class="box">
                    <div class="box-header with-border">
                    </div>
                    <div class="box-body">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="user">Користувач*</label>
                                <select class="form-control select2" id="user" name="user">
                                    <option value="" selected>Немає</option>

                                    @foreach($users as $user)
                                        <option value="{{$user->id}}"
                                            {{$qualification->user->id == $user->id ? 'selected' : ''}}>
                                                {{$user->getFullName()}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name">Категорія*</label>
                                <select class="form-control select2" id="name" name="name">
                                    <option value="">Немає</option>

                                    @foreach($qualificationNames as $qualificationName)
                                        <option value="{{$qualificationName}}"
                                                {{$qualification->name == $qualificationName ? 'selected' : ''}}>
                                            {{$qualificationName}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="date">Дата Встановлення категорії*</label>
                                <input type="text" class="form-control pull-right calendar"
                                       value="{{to_locale_date($qualification->date)}}"
                                       name="date" id="date" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="description">Опис</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="10">
                                    {!! $qualification->description !!}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{url()->previous()}}">
                            <button type="button" class="btn btn-default">Назад</button>
                        </a>

                        <button class="btn btn-success pull-right">Редагувати</button>
                    </div>
                    <!-- /.box-footer-->
                </div>
            </form>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
@endsection
