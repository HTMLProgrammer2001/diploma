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
                                <img src="{{$user->getAvatar()}}" alt="" style="max-width: 100%;">
                            </div>

                            <div class="col-sm-7 col-sm-offset-1">
                                <div>Ім'я: {{$user->getFullName()}}</div>
                                <div>Дата народження: {{$user->getBirthdayString()}}</div>
                                <div>Email: {{$user->email}}</div>
                                <div>Роль: {{$user->getRoleString()}}</div>
                                <div>Відділ: {{$user->getDepartmentName()}}</div>
                                <div>Циклова комісія: {{$user->getCommissionName()}}</div>
                                <div>Кваліфікація: {{$user->getQualificationName()}}</div>
                                <div>Розряд: {{$user->getRankName()}}</div>
                            </div>
                        </div>
                        
                        <ul class="nav nav-tabs" id="profile_tab" role="tablist">
                            <li class="nav-item active">
                                <a class="nav-link" id="publications_tab" data-toggle="tab"
                                   href="#publications" role="tab">Публікації</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="internships_tab" data-toggle="tab"
                                   href="#internships" role="tab">Стажування</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="qualifications_tab" data-toggle="tab"
                                   href="#qualifications" role="tab">Встановлення/Підтвердження кваліфікацій</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="profile_tab_content">
                            @include('admin.profile.show.publications')
                            @include('admin.profile.show.internships')
                            @include('admin.profile.show.qualifications')
                            @include('admin.profile.show.rebukes')
                            @include('admin.profile.show.honors')
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{url()->previous()}}">
                            <button type="button" class="btn btn-default">Назад</button>
                        </a>

                        <a href="{{route('profile.edit')}}">
                            <button class="btn btn-warning pull-right">Редагувати</button>
                        </a>
                    </div>
                    <!-- /.box-footer-->
                </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>

    <script src="/js/pagination.js"></script>
    <script src="/js/remover.js"></script>
    <script>
		paginate('#publications_paginate', '#publications_content', '{{route('profile.publications.paginate')}}', () => {
			remover('#publications_content .deleteItem', '#publications_content .crud-item');
		});
		paginate('#internships_paginate', '#internships_content', '{{route('profile.internships.paginate')}}', () => {
			remover('#internships_content .deleteItem', '#internships_content .crud-item');
		});
		paginate('#qualifications_paginate', '#qualifications_content', '{{route('profile.qualifications.paginate')}}', () => {
			remover('#qualifications_content .deleteItem', '#qualifications_content .crud-item');
		});
    </script>
@endsection
