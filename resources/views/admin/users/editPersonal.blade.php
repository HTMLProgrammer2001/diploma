<div class="tab-pane active in" id="personal">
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">Ім'я</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
            </div>

            <div class="form-group">
                <label for="surname">Прізвище</label>
                <input type="text" class="form-control" id="surname" name="surname" value="{{$user->surname}}">
            </div>

            <div class="form-group">
                <label for="patronymic">По-батькові</label>
                <input type="text" class="form-control" id="patronymic" name="patronymic"
                       value="{{$user->patronymic}}">
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" class="form-control" id="email" name="email"
                       value="{{$user->email}}">
            </div>

            <div class="form-group">
                <label for="department">Дата народження</label>
                <input type="text" class="form-control pull-right calendar"
                       value="{{to_locale_date($user->birthday)}}" name="birthday" autocomplete="off">
            </div>

            <div class="form-group">
                <label for="phone">Телефон</label>
                <input type="text" class="form-control" id="phone" name="phone"
                       value="{{$user->phone}}">
            </div>

        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" id="password" name="password"
                       placeholder="">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Повторіть пароль</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="">
            </div>


            <div class="form-group">
                <label for="patronymic">Номер паспорта</label>
                <input type="text" class="form-control" id="patronymic" name="passport" value="">
            </div>

            <div class="form-group">
                <label for="code">Ідентифікаційний код</label>
                <input type="text" class="form-control" id="code" name="code" value="">
            </div>

            <div class="form-group">
                <label for="address">Адреса</label>
                <input type="text" class="form-control" id="address" name="address"
                       value="{{$user->address}}">
            </div>

        </div>
    </div>

    <div class="form-group">
        <label for="avatar">Аватар</label>
        <img src="{{$user->getAvatar()}}" alt="" class="img-responsive" width="150" style="margin: 20px">
        <input type="file" id="avatar" name="avatar">

        <p class="help-block">Зображення в форматах jpeg чи png</p>
    </div>
</div>
