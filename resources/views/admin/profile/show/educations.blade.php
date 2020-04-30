<div class="tab-pane fade" id="educations" role="tabpanel">
    <h3>Освіта</h3>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Викладач</th>
            <th>Заклад освіти</th>
            <th>Рік випуску</th>
            <th>Кваліфікація</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody id="educations_content"></tbody>
    </table>

    <div style="margin-top: 20px">
        <div class="pull-right paginator" id="educations_paginate">
            {{$educations->onEachSide(5)->links()}}
        </div>

        <a href="#" class="btn-block pull-left">
            <button class="btn btn-success margin-bottom">Додати</button>
        </a>
    </div>
</div>
