<div class="tab-pane fade" id="professional">
    <div class="row mt-4">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="department">Відділення</label>
                <select class="form-control select2" id="department" name="department"
                        value="{{$user->getDepartmentID()}}">
                    <option value="">Немає</option>

                    @foreach($departments as $department)
                        <option value="{{$department->id}}"
                                {{$user->getDepartmentID() == $department->id ? ' selected' : ''}}>{{$department->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="commission">Циклова комісія</label>
                <select class="form-control select2" id="commission" name="commission">
                    <option value="">Немає</option>

                    @foreach($commissions as $commission)
                        <option value="{{$commission->id}}"
                                {{$user->getCommissionID() == $commission->id ? ' selected' : ''}}>{{$commission->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="role">Роль</label>
                <select class="form-control select2" id="role" name="role">
                    @foreach($roles as $key => $name)
                        <option value="{{$key}}"
                                {{$user->role == $key ? ' selected' : ''}}>{{$name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="rank">Розряд</label>
                <select class="form-control select2" id="rank" name="rank">
                    <option value="" selected>Немає</option>

                    @foreach($ranks as $rank)
                        <option value="{{$rank->id}}"
                                {{$user->getRankID() == $rank->id ? 'selected' : ''}}
                        >{{$rank->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="hiring_year">Рік прийняття на роботу</label>
                <input type="number" class="form-control" id="hiring_year"
                       name="hiring_year" placeholder="" value="{{$user->hiring_year}}">
            </div>

            <div class="form-group">
                <label for="pedagogical_title">Педагогічне звання</label>
                <select class="form-control select2" id="pedagogical_title"
                        name="pedagogical_title">
                    <option value="" selected>Немає</option>

                    @foreach($pedagogicals as $pedagogical)
                        <option value="{{$pedagogical}}"
                                {{$user->pedagogical_title == $pedagogical ? 'selected' : ''}}
                        >{{$pedagogical}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="experience">Стаж</label>
                <input type="number" class="form-control" id="experience"
                       name="experience" placeholder="Стаж в роках" value="{{$user->experience}}">
            </div>

            <div class="form-group">
                <label for="scientific_degree">Вчене звання</label>
                <select class="form-control select2" id="scientific_degree" name="scientific_degree">
                    <option value="" selected>Немає</option>

                    @foreach($scientifics as $scientific)
                        <option value="{{$scientific}}"
                                {{$scientific == $user->scientific_degree ? 'selected' : ''}}
                        >{{$scientific}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="scientific_degree_year">Рік встановлення вченого звання</label>
                <input type="number" class="form-control" id="scientific_degree_year"
                       name="scientific_degree_year" placeholder="" value="{{$user->scientific_degree_year}}">
            </div>

            <div class="form-group">
                <label for="academic_status">Наукова ступінь</label>
                <select class="form-control select2" id="academic_status" name="academic_status">
                    <option value="" selected>Немає</option>

                    @foreach($academics as $academic)
                        <option value="{{$academic}}"
                                {{$user->academic_status == $academic ? 'selected' : ''}}
                        >{{$academic}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="academic_status_year">Рік встановлення наукового ступеня</label>
                <input type="number" class="form-control" id="academic_status_year"
                       name="academic_status_year" placeholder="" value="{{$user->academic_status_year}}">
            </div>
        </div>
    </div>
</div>
