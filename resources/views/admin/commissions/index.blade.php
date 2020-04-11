@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Комісії
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('commissions.index')}}">Комісії</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{route('commissions.create')}}" class="btn btn-success">Додати</a>
                    </div>
                    <table class="custom-table table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Назва</th>
                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($commissions as $commission)
                            <tr>
                                <td>{{$commission->id}}</td>
                                <td>{{$commission->name}}</td>
                                <td style="display: flex">
                                    <a href="{{route('commissions.edit', $commission->id)}}" class="fa fa-pencil"></a>

                                    <form action="{{route('commissions.destroy', $commission->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <label for="delete_{{$commission->id}}" onclick="return confirm('Ви впевнені?')">
                                            <a class="fa fa-remove"></a>
                                        </label>

                                        <button type="submit" id="delete_{{$commission->id}}" class="hidden"></button>
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
