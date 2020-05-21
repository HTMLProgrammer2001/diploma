@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Викладачі
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Головна</a></li>
                <li><a href="{{route('users.index')}}">Викладачі</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">

                    @can('moderate')
                        <div class="pull-left">
                            <a href="{{route('users.create')}}" class="btn btn-success">Додати</a>
                        </div>

                        <div class="pull-right">
                            <a href="{{route('users.import')}}" class="btn btn-info">Імпорт</a>
                        </div>
                    @endcan

                        <div class="w-100 mb-3 d-flex justify-content-center">
                            <form class="user-form col-lg-8 d-flex flex-column align-items-center">
                                <div class="row w-100">
                                    <div class="form-group col d-flex flex-column">
                                        <label for="name">Ім'я</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                               placeholder="Ім'я викладача"/>
                                    </div>

                                    <div class="form-group col d-flex flex-column">
                                        <label for="email">Email</label>
                                        <input type="text" id="email" name="email" class="form-control"
                                               placeholder="Email"/>
                                    </div>
                                </div>

                                <div class="row w-100">
                                    <div class="form-group d-flex flex-column col">
                                        <label for="commission">Циклова комісія</label>
                                        <select class="form-control select2" id="commission" name="commission">
                                            <option value="" selected>Всі</option>
                                            @foreach($commissions as $commission)
                                                <option value="{{$commission->id}}">{{$commission->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group d-flex flex-column col">
                                        <label for="department">Відділення</label>
                                        <select class="form-control select2" id="department" name="department">
                                            <option value="" selected>Всі</option>
                                            @foreach($departments as $department)
                                                <option value="{{$department->id}}">{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row w-100">
                                    <div class="form-group d-flex flex-column col">
                                        <label for="rank">Посада</label>
                                        <select class="form-control select2" id="rank" name="rank">
                                            <option value="" selected>Всі</option>
                                            @foreach($ranks as $rank)
                                                <option value="{{$rank->id}}">{{$rank->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group d-flex flex-column col">
                                        <label for="pedagogical">Педагогічне звання</label>
                                        <select class="form-control select2" id="pedagogical" name="pedagogical">
                                            <option value="" selected>Всі</option>
                                            @foreach($pedagogicals as $pedagogical)
                                                <option value="{{$pedagogical}}">{{$pedagogical}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group d-flex flex-column w-50">
                                    <label for="category">Категорія</label>
                                    <select class="form-control select2" id="category" name="category">
                                        <option value="" selected>Всі</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category}}">{{$category}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button class="btn btn-info w-50">Пошук</button>
                            </form>
                        </div>

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>
                                <div class="d-flex justify-content-between w-100">
                                    <span>ID</span>
                                    <span data-state="0" data-name="sortID"
                                          class="users-sort fa fa-sort-amount-asc opacity-5"></span>
                                </div>
                            </th>
                            <th>
                                <div class="d-flex justify-content-between w-100">
                                    <span>Ім'я</span>
                                    <span data-state="0" data-name="sortName"
                                          class="users-sort fa fa-sort-amount-asc opacity-5"></span>
                                </div>
                            </th>
                            <th>
                                <div class="d-flex justify-content-between w-100">
                                    <span>E-mail</span>
                                    <span data-state="0" data-name="sortEmail"
                                          class="users-sort fa fa-sort-amount-asc opacity-5"></span>
                                </div>
                            </th>
                            <th>Аватар</th>
                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody class="user-content">
                            @include('admin.users.paginate')
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
