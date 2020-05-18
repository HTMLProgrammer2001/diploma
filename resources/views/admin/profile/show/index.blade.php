@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Профіль користувача {{$user->getFullName()}}
            </h1>

            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('profile.show')}}">Профіль</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
                <div class="box">
                    <div class="box-body">
                        <div class="row margin-bottom">
                            <div class="col-sm-3">
                                <img src="{{$user->getAvatar()}}" alt="" style="width: 100%;">
                            </div>

                            <div class="col-sm-7 col-sm-offset-1">
                                <div>Ім'я: {{$user->getFullName()}}</div>
                                <div>Дата народження: {{to_locale_date($user->birthday)}}</div>
                                <div>Email: {{$user->email}}</div>

                                @if($user->address)
                                    <div>Адреса: {{$user->address}}</div>
                                @endif

                                @if($user->phone)
                                    <div>Номер телефона: {{$user->phone}}</div>
                                @endif

                                <div>Роль: {{$user->getRoleString()}}</div>
                                <div>Відділ: {{$user->getDepartmentName()}}</div>
                                <div>Циклова комісія: {{$user->getCommissionName()}}</div>
                                <div>Кваліфікація: {{$userQualification}}</div>
                                <div>Розряд: {{$user->getRankName()}}</div>

                                @if($user->hiring_year)
                                    <div>Рік прийняття на роботу: {{$user->hiring_year}}</div>
                                @endif

                                <div>Педагогічне звання: {{$user->pedagogical_title}}</div>
                                <div>Стаж: {{$user->experience}}</div>
                            </div>
                        </div>
                        
                        <ul class="nav nav-tabs" id="profile_tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="publications_tab" data-toggle="tab"
                                   href="#publications" role="tab">Публікації</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="internships_tab" data-toggle="tab"
                                   href="#internships" role="tab">Стажування</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="qualifications_tab" data-toggle="tab"
                                   href="#qualifications" role="tab">Встановлення/Підтвердження категорій</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="honors_tab" data-toggle="tab"
                                   href="#honors" role="tab">Нагороди</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="rebukes_tab" data-toggle="tab"
                                   href="#rebukes" role="tab">Догани</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="educations_tab" data-toggle="tab"
                                   href="#educations" role="tab">Освіта</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="profile_tab_content">
                            @include('admin.profile.show.publications')
                            @include('admin.profile.show.internships')
                            @include('admin.profile.show.qualifications')
                            @include('admin.profile.show.rebukes')
                            @include('admin.profile.show.honors')
                            @include('admin.profile.show.educations')
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{url()->previous()}}" class="pull-left">
                            <button type="button" class="btn btn-default">Назад</button>
                        </a>

                        @if($isProfile)
                            <a href="{{route('profile.edit')}}" class="pull-right">
                                <button class="btn btn-warning text-white">Редагувати</button>
                            </a>

                        @else
                            <a href="{{route('users.edit', $user->id)}}" class="pull-right">
                                <button class="btn btn-warning text-white">Редагувати</button>
                            </a>
                        @endif
                    </div>
                    <!-- /.box-footer-->
                </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection
