<div class="tab-pane fade" id="qualifications" role="tabpanel">
    <h3>Встановлення/Підтвердження кваліфікацій</h3>

    <div class="w-100 my-3 d-flex justify-content-center">
        <form class="qualifications-form col-lg-8 d-flex flex-column align-items-center">
            <div class="row w-100">
                <div class="form-group d-flex flex-column col">
                    <label for="category">Категорія</label>
                    <select class="form-control select2" id="category" name="category">
                        <option value="" selected>Всі</option>
                        @foreach($qCategories as $qCategory)
                            <option value="{{$qCategory}}">{{$qCategory}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row w-100">
                <div class="form-group d-flex flex-column col">
                    <label for="start_date">З</label>

                    <input type="text" class="form-control pull-right calendar"
                           value="" name="start_date"
                           id="start_date" autocomplete="off">
                </div>

                <div class="form-group d-flex flex-column col">
                    <label for="end_date">До</label>

                    <input type="text" class="form-control pull-right calendar"
                           value="" name="end_date"
                           id="end_date" autocomplete="off">
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
                          class="qualifications-sort fa fa-sort-amount-asc opacity-5"></span>
                </div>
            </th>
            <th>Користувач</th>
            <th>
                <div class="d-flex justify-content-between w-100">
                    <span>Категорія</span>
                    <span data-state="0" data-name="sortName"
                          class="qualifications-sort fa fa-sort-amount-asc opacity-5"></span>
                </div>
            </th>
            <th>
                <div class="d-flex justify-content-between w-100">
                    <span>Дата</span>
                    <span data-state="0" data-name="sortDate"
                          class="qualifications-sort fa fa-sort-amount-asc opacity-5"></span>
                </div>
            </th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody class = "qualifications-content">
            @include('admin.qualifications.paginate')
        </tbody>
    </table>

    <b>Термін наступного підтвердження: {{$nextQualification}}</b>

    <div class="mt-2">
        <a href="{{route('profile.qualifications.create')}}" class="btn-block pull-left">
            <button class="btn btn-success margin-bottom">Додати</button>
        </a>
    </div>
</div>
