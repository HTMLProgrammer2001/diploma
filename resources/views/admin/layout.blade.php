<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="token" content="{{csrf_token()}}">
    <title>AdminLTE 2</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/admin.css">

    <script src="/js/admin.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle p-0" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{$user->getAvatar()}}" class="user-image" alt="Аватар">
                            <span class="hidden-xs">{{$user->getShortName()}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{$user->getAvatar()}}" class="img-circle" alt="Аватар">

                                <p>
                                    {{$user->getShortName() . ', ' . $user->getRoleString()}}
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{route('profile.show')}}" class="btn btn-default btn-flat">Профіль</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{route('logout')}}" class="btn btn-default btn-flat">Вийти</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{$user->getAvatar()}}" class="img-circle" alt="Аватар">
                </div>
                <div class="pull-left info">
                    <p>{{$user->getShortName()}}</p>
                </div>
            </div>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">Навігаційне меню</li>
                <li class="treeview"><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> <span>Адмін панель</span></a></li>
                <li><a href="{{route('profile.show')}}"><i class="fa fa-user"></i> <span>Профіль</span></a></li>

                @can('view')
                    <li>
                        <a href="{{route('publications.index')}}">
                            <i class="fa fa-sticky-note-o"></i>
                            <span>Публікації</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('commissions.index')}}">
                            <i class="fa fa-list-ul"></i>
                            <span>Циклові комісії</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('departments.index')}}">
                            <i class="fa fa-tags"></i>
                            <span>Відділення</span></a>
                    </li>

                    <li>
                        <a href="{{route('users.index')}}">
                            <i class="fa fa-users"></i>
                            <span>Викладачі</span></a>
                    </li>

                    <li>
                        <a href="{{route('internships.index')}}">
                            <i class="fa fa-map-marker"></i>
                            <span>Стажування</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('qualifications.index')}}">
                            <i class="fa fa-map-marker"></i>
                            <span>Встановлення категорій</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('places.index')}}">
                            <i class="fa fa-map-marker"></i>
                            <span>Місця стажування</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('categories.index')}}">
                            <i class="fa fa-list"></i>
                            <span>Категорії стажування</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('honors.index')}}">
                            <i class="fa fa-list"></i>
                            <span>Нагороди</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('rebukes.index')}}">
                            <i class="fa fa-list"></i>
                            <span>Догани</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('ranks.index')}}">
                            <i class="fa fa-list"></i>
                            <span>Розряди</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('educations.index')}}">
                            <i class="fa fa-list"></i>
                            <span>Освіти</span>
                        </a>
                    </li>
                @endcan

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    @yield('content')

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.7
        </div>
        <strong>Copyright &copy; 2020 <a href="http://almsaeedstudio.com/">Yuri Prosyazhny</a>.</strong> All rights
        reserved.
    </footer>
</div>
<!-- ./wrapper -->
<!-- page script -->
</body>

</html>
