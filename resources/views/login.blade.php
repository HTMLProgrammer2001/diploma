<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/admin.css">
    <title>Login</title>
</head>
<body style="display: flex">
    <section class="content col-sm-6" style="justify-self: center">
    <!-- Default box -->
    <form action="{{route('login')}}" method="post">
        @csrf

        <div class="box">
            <div class="box-header with-border">
                <h3>
                    Авторизация
                </h3>
            </div>
            <div class="box-body">
                @if(session('loginError'))
                    <div class="alert alert-danger">
                        {{session('loginError')}}
                    </div>
                @endif

                @include('admin.errors')

                <div class="col-md-8">
                    <div class="form-group">
                        <label for="email">Email*</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}">
                    </div>

                    <div class="form-group">
                        <label for="password">Пароль*</label>
                        <input type="password" class="form-control" id="password" name="password" value="">
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button class="btn btn-success pull-right">Войти</button>
            </div>
            <!-- /.box-footer-->
        </div>
    </form>
    <!-- /.box -->
</section>
</body>
</html>
