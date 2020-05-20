<div class="tab-pane active in" id="publications" role="tabpanel"
     aria-labelledby="home-tab">
    <h3>Публікації</h3>

    <div class="w-100 my-3 d-flex justify-content-center">
        <form class="publications-form col-lg-8 d-flex flex-column align-items-center">
            <div class="row w-100">
                <div class="form-group col d-flex flex-column">
                    <label for="title">Назва публікації</label>
                    <input type="text" id="title" name="title" class="form-control"
                           placeholder="Назва публікації"/>
                </div>
            </div>

            <div class="row w-100">
                <div class="form-group d-flex flex-column col">
                    <label for="start_date_of_publication">З</label>

                    <input type="text" class="form-control pull-right calendar"
                           value="" name="start_date_of_publication"
                           id="start_date_of_publication" autocomplete="off">
                </div>

                <div class="form-group d-flex flex-column col">
                    <label for="end_date_of_publication">До</label>

                    <input type="text" class="form-control pull-right calendar"
                           value="" name="end_date_of_publication"
                           id="end_date_of_publication" autocomplete="off">
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
                          class="publications-sort fa fa-sort-amount-asc opacity-5"></span>
                </div>
            </th>
            <th>
                <div class="d-flex justify-content-between w-100">
                    <span>Назва</span>
                    <span data-state="0" data-name="sortName"
                          class="publications-sort fa fa-sort-amount-asc opacity-5"></span>
                </div>
            </th>
            <th>Автори</th>
            <th>
                <div class="d-flex justify-content-between w-100">
                    <span>Дата публікації</span>
                    <span data-state="0" data-name="sortDate"
                          class="publications-sort fa fa-sort-amount-asc opacity-5"></span>
                </div>
            </th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody class="publications-content">
            @include('admin.publications.paginate')
        </tbody>
    </table>

{{--    <a href="{{route('profile.publications.create')}}" class="pull-left">--}}
{{--        <button class="btn btn-success margin-bottom">Додати</button>--}}
{{--    </a>--}}
</div>
