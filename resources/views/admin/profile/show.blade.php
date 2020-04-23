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
                            <div class="tab-pane fade show active in" id="publications" role="tabpanel"
                                 aria-labelledby="home-tab">
                                    <h3>Публікації</h3>

                                    <table class="custom-table table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Назва</th>
                                                <th>Автори</th>
                                                <th>Дії</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($user->publications as $publication)
                                                <tr>
                                                    <td>{{$publication->id}}</td>
                                                    <td>{{$publication->title}}</td>
                                                    <td>{{$publication->getAuthorsString()}}</td>
                                                    <td>
                                                        <a href="{{route('profile.publications.edit', $publication->id)}}"
                                                        class="fa fa-pencil"></a>
                                                        <form action="{{route('profile.publications.destroy', $publication->id)}}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <label for="delete_{{$publication->id}}"
                                                                onclick="return confirm('Ви впевнені?')">

                                                                <a class="fa fa-remove"></a>
                                                            </label>

                                                            <button type="submit" id="delete_{{$publication->id}}"
                                                                class="hidden"></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <a href="{{route('profile.publications.create')}}">
                                        <button class="btn btn-success margin-bottom">Додати</button>
                                    </a>
                            </div>

                            <div class="tab-pane fade" id="internships" role="tabpanel">
                                <h3>Стажування</h3>

                                <table class="custom-table table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Тема</th>
                                            <th>Місце</th>
                                            <th>Дата кінця</th>
                                            <th>Дії</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user->internships as $internship)
                                            <tr>
                                                <td>{{$internship->id}}</td>
                                                <td>{{$internship->title}}</td>
                                                <td>{{$internship->getPlaceName()}}</td>
                                                <td>{{$internship->to}}</td>
                                                <td>
                                                    <a href="{{route('profile.internships.edit', $internship->id)}}"
                                                        class="fa fa-pencil"></a>
                                                    <form action="{{route('profile.internships.destroy', $internship->id)}}"
                                                          method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <label for="delete_{{$internship->id}}"
                                                           onclick="return confirm('Ви впевнені?')">
                                                            <a class="fa fa-remove"></a>
                                                        </label>

                                                        <button type="submit" id="delete_{{$internship->id}}"
                                                            class="hidden"></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <b>Годин з останнього підвищення кваліфікації: {{$user->getInternshipHours()}}</b>

                                <a href="{{route('profile.internships.create')}}" class="btn-block" style="margin-top: 20px">
                                    <button class="btn btn-success margin-bottom">Додати</button>
                                </a>
                            </div>

                            <div class="tab-pane fade" id="qualifications" role="tabpanel">
                                <h3>Встановлення/Підтвердження кваліфікацій</h3>

                                <table class="custom-table table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Кваліфікація</th>>
                                        <th>Дата</th>
                                        <th>Дії</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user->qualifications as $qualification)
                                        <tr>
                                            <td>{{$qualification->id}}</td>
                                            <td>{{$qualification->name}}</td>
                                            <td>{{$qualification->date}}</td>
                                            <td>
                                                <form action="{{route('profile.qualifications.destroy', $qualification->id)}}"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <label for="delete_{{$qualification->id}}"
                                                           onclick="return confirm('Ви впевнені?')">
                                                        <a class="fa fa-remove"></a>
                                                    </label>

                                                    <button type="submit" id="delete_{{$qualification->id}}"
                                                            class="hidden"></button>
                                                </form>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <a href="{{route('profile.qualifications.create')}}" class="btn-block">
                                    <button class="btn btn-success margin-bottom">Додати</button>
                                </a>
                            </div>
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
@endsection
