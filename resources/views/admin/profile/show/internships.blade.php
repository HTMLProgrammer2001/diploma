<div class="tab-pane fade" id="internships" role="tabpanel">
    <h3>Стажування</h3>

    <div class="w-100 mb-3 d-flex justify-content-center">
        <form class="internships-form col-lg-8 d-flex flex-column align-items-center">
            <div class="row w-100">
                <div class="form-group d-flex flex-column col">
                    <label for="category">Категорія</label>
                    <select class="form-control select2" id="category" name="category">
                        <option value="" selected>Всі</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group d-flex flex-column align-items-center col">
                    <label for="title">Тема</label>

                    <input type="text" class="form-control pull-right"
                           value="" name="title"
                           id="title" autocomplete="off">
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

            <div class="row w-100">
                <div class="form-group d-flex flex-column col">
                    <label for="start_hours">Кількість годин більше</label>

                    <input type="number" class="form-control pull-right"
                           value="" name="start_hours"
                           id="start_hours" autocomplete="off">
                </div>

                <div class="form-group d-flex flex-column col">
                    <label for="end_hours">Кількість годин менша</label>

                    <input type="number" class="form-control pull-right"
                           value="" name="end_hours"
                           id="end_hours" autocomplete="off">
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
                          class="internships-sort fa fa-sort-amount-asc opacity-5"></span>
                </div>
            </th>
            <th>Користувач</th>
            <th>
                <div class="d-flex justify-content-between w-100">
                    <span>Категорія</span>
                    <span data-state="0" data-name="sortCategory"
                          class="internships-sort fa fa-sort-amount-asc opacity-5"></span>
                </div>
            </th>
            <th>
                <div class="d-flex justify-content-between w-100">
                    <span>Тема</span>
                    <span data-state="0" data-name="sortTitle"
                          class="internships-sort fa fa-sort-amount-asc opacity-5"></span>
                </div>
            </th>
            <th>
                <div class="d-flex justify-content-between w-100">
                    <span>Кількість годин</span>
                    <span data-state="0" data-name="sortHours"
                          class="internships-sort fa fa-sort-amount-asc opacity-5"></span>
                </div>
            </th>
            <th>
                <div class="d-flex justify-content-between w-100">
                    <span>Дата закінчення</span>
                    <span data-state="0" data-name="sortDate"
                          class="internships-sort fa fa-sort-amount-asc opacity-5"></span>
                </div>
            </th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody class="internships-content">
            @include('admin.internships.paginate')
        </tbody>
    </table>

    <b>Годин з останнього підвищення кваліфікації: {{$internshipHours}}</b>

    <div style="margin-top: 20px">
        <a href="{{route('profile.internships.create')}}" class="btn-block pull-left">
            <button class="btn btn-success margin-bottom">Додати</button>
        </a>
    </div>
</div>
