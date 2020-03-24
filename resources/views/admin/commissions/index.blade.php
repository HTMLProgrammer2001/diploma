@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Коммиссии
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Главная</a></li>
                <li><a href="{{route('commissions.index')}}">Коммиссии</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Листинг сущности</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{route('commissions.create')}}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($commissions as $commission)
                            <tr>
                                <td>{{$commission->id}}</td>
                                <td>{{$commission->name}}</td>
                                <td style="display: flex">
                                    <a href="{{route('commissions.edit', $commission->id)}}" class="fa fa-pencil"></a>

                                    <form action="{{route('commissions.destroy', $commission->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <label for="delete">
                                            <a class="fa fa-remove"></a>
                                        </label>

                                        <button type="submit" id="delete" class="hidden"></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection
