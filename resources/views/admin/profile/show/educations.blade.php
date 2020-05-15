<div class="tab-pane fade" id="educations" role="tabpanel">
    <h3>Освіта</h3>

    <div class="w-100 my-3 d-flex justify-content-center">
        <form class="educations-form col-lg-8 d-flex flex-column align-items-center">
            <div class="row w-100">
                <div class="form-group d-flex flex-column col">
                    <label for="qualification">Кваліфікація</label>
                    <select class="form-control select2" id="qualification" name="qualification">
                        <option value="">Всі</option>
                        @foreach($qNames as $qName)
                            <option value="{{$qName}}">{{$qName}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row w-100">
                <div class="form-group col d-flex flex-column">
                    <label for="name">Назва закладу</label>
                    <input type="text" id="name" name="name" class="form-control"
                           placeholder="Назва закладу"/>
                </div>

                <div class="form-group col d-flex flex-column">
                    <label for="graduate_year">Рік випуску</label>
                    <input type="number" id="graduate_year" name="graduate_year"
                           class="form-control" placeholder="Рік випуску"/>
                </div>
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
                          class="educations-sort fa fa-sort-amount-asc opacity-5"></span>
                </div>
            </th>
            <th>Викладач</th>
            <th>
                <div class="d-flex justify-content-between w-100">
                    <span>Заклад освіти</span>
                    <span data-state="0" data-name="sortInstitution"
                          class="educations-sort fa fa-sort-amount-asc opacity-5"></span>
                </div>
            </th>
            <th>
                <div class="d-flex justify-content-between w-100">
                    <span>Рік випуску</span>
                    <span data-state="0" data-name="sortYear"
                          class="educations-sort fa fa-sort-amount-asc opacity-5"></span>
                </div>
            </th>
            <th>
                <div class="d-flex justify-content-between w-100">
                    <span>Кваліфікація</span>
                    <span data-state="0" data-name="sortQualification"
                          class="educations-sort fa fa-sort-amount-asc opacity-5"></span>
                </div>
            </th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody class="educations-content">
            @include('admin.educations.paginate')
        </tbody>
    </table>

    <div class="mt-2">
        <a href="{{route('profile.educations.create')}}" class="btn-block pull-left">
            <button class="btn btn-success margin-bottom">Додати</button>
        </a>
    </div>
</div>
