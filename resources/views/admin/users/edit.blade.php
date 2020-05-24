@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Редагувати викладача
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('users.index')}}">Викладачі</a></li>
                <li><a href="{{route('users.edit', $user->id)}}">Редагувати</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <form action="{{route('users.update', $user->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.errors')

                <div class="box">
                    <div class="box-body">

                        <ul class="nav nav-tabs" id="user_tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="personal_tab" data-toggle="tab"
                                   href="#personal" role="tab">Особисті дані</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profession_tab" data-toggle="tab"
                                   href="#professional" role="tab">Професійні дані</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="user_tab_content">
                            @include('admin.users.editPersonal')
                            @include('admin.users.editProfessional')
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{url()->previous()}}">
                            <button type="button" class="btn btn-default">Назад</button>
                        </a>

                        <button class="btn btn-warning pull-right">Редагувати</button>
                    </div>
                    <!-- /.box-footer-->
                </div>
            </form>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection
