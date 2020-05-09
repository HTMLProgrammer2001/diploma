<div class="tab-pane fade" id="rebukes" role="tabpanel">
    <h3>Догани</h3>

    <div class="w-100 my-3 d-flex justify-content-center">
        <form class="rebukes-form col-lg-8 d-flex flex-column align-items-center">
            <div class="row w-100">
                <div class="form-group d-flex flex-column col">
                    <label for="name">Назва догани</label>
                    <input type="text" id="name" name="name" class="form-control"
                           placeholder="Назва закладу"/>
                </div>
            </div>

            <div class="row w-100">
                <div class="form-group d-flex flex-column col">
                    <label for="start_date_presentation">З</label>

                    <input type="text" class="form-control pull-right calendar"
                           value="" name="start_date_presentation"
                           id="start_date_presentation" autocomplete="off">
                </div>

                <div class="form-group d-flex flex-column col">
                    <label for="end_date_presentation">До</label>

                    <input type="text" class="form-control pull-right calendar"
                           value="" name="end_date_presentation"
                           id="end_date_presentation" autocomplete="off">
                </div>
            </div>


            <button class="btn btn-info w-50">Пошук</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Викладач</th>
            <th>Назва догани</th>
            <th>Дата отримання</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody class="rebukes-content">
            @include('admin.rebukes.paginate')
        </tbody>
    </table>
</div>
