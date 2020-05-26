@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Імпорт нагород
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('honors.index')}}">Нагороди</a></li>
                <li><a href="{{route('honors.import')}}">Імпорт</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <form action="{{route('honors.import')}}" method="post" class="import-form"
                  enctype="multipart/form-data">
                @if(isset($successMsg))
                    <div class="alert alert-success">
                        <ul>
                            {{$successMsg}}
                        </ul>
                    </div>
                @endif

                @include('admin.errors')
                @csrf

                <div class="box">
                    <div class="box-body d-flex justify-content-center">
                        <div class="col-md-6 d-flex flex-column align-items-center">
                            <div class="form-group w-100 d-flex flex-column align-items-center">
                                <div class="custom-file">
                                    <label for="file" class="text-center custom-file-label">
                                        Файл в форматі csv чи xlsx
                                    </label>

                                    <input type="file" class="custom-file-input" id="file" name="file">
                                </div>

                                <a href="{{route('honors.example')}}" download="" class="d-block mt-3">
                                    Завантажити зразок
                                </a>
                            </div>


                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{url()->previous()}}" class="pull-left">
                            <button type="button" class="btn btn-default">Назад</button>
                        </a>

                        <button class="btn btn-success pull-right">Імпорт</button>
                    </div>
                    <!-- /.box-footer-->
                </div>
            </form>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
@endsection
