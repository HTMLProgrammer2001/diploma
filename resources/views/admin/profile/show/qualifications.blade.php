<div class="tab-pane fade" id="qualifications" role="tabpanel">
    <h3>Встановлення/Підтвердження кваліфікацій</h3>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Кваліфікація</th>>
            <th>Дата</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody id = "qualifications_content"></tbody>
    </table>

    <div class="pull-right paginator" id="qualifications_paginate">
        {{$qualifications->onEachSide(5)->links()}}
    </div>

    <a href="{{route('profile.qualifications.create')}}" class="btn-block">
        <button class="btn btn-success margin-bottom">Додати</button>
    </a>
</div>
