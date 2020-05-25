<div class="modal" tabindex="-1" role="dialog" id="user-{{$user->id}}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$user->getFullName()}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#personal-{{$user->id}}"
                           role="tab">Персональна інформація</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#professional-{{$user->id}}"
                           role="tab">Трудова діяльність</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="personal-{{$user->id}}" role="tabpanel">
                        <table class="table">
                            <thead>
                            <tr class="bg-white">
                                <th scope="col">Поле</th>
                                <th scope="col">Значение</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-white">
                                <td>ФІО</td>
                                <td>{{$user->getFullName()}}</td>
                            </tr>

                            <tr class="bg-white">
                                <td>Дата народження</td>
                                <td>{{to_locale_date($user->birthday)}}</td>
                            </tr>

                            <tr class="bg-white">
                                <td>Освіта викладача</td>
                                <td>{{$educationRep->getUserString($user->id)}}</td>
                            </tr>

                            <tr class="bg-white">
                                <td>Рік прийняття на роботу</td>
                                <td>{{$user->hiring_year}}</td>
                            </tr>

                            <tr class="bg-white">
                                <td>Вислуга років на 2020 рік</td>
                                <td>{{$user->experience}}</td>
                            </tr>

                            <tr class="bg-white">
                                <td>Домашня адреса, телефон, email</td>
                                <td>{{$user->address}}, {{$user->phone}}, {{$user->email}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade" id="professional-{{$user->id}}" role="tabpanel">
                        <table class="table">
                            <thead>
                            <tr class="bg-white">
                                <th scope="col">Поле</th>
                                <th scope="col">Значение</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-white">
                                <td>Посада</td>
                                <td>{{$user->getRankName()}}</td>
                            </tr>

                            <tr class="bg-white">
                                <td>Категорія, рік встановлення</td>
                                <td>
                                    {{$qualificationRep->getQualificationNameOf($user->id)}},
                                    {{to_locale_date($qualificationRep->getLastQualificationDateOf($user->id))}}
                                </td>
                            </tr>

                            <tr class="bg-white">
                                <td>Педагогічне звання</td>
                                <td>
                                    {{$user->pedagogical_title}}
                                </td>
                            </tr>

                            @if($user->academic_status)
                                <tr class="bg-white">
                                    <td>Науковий ступінь, рік встановлення</td>
                                    <td>
                                        {{$user->academic_status}},
                                        {{$user->academic_status_year}}
                                    </td>
                                </tr>
                            @endif

                            @if($user->scientific_degree)
                                <tr class="bg-white">
                                    <td>Науковий ступінь, рік встановлення</td>
                                    <td>
                                        {{$user->scientific_degree}},
                                        {{$user->scientific_degree_year}}
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
