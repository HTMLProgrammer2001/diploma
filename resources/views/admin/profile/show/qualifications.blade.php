<div class="tab-pane fade" id="qualifications" role="tabpanel">
    <h3>Встановлення/Підтвердження кваліфікацій</h3>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Користувач</th>>
            <th>Кваліфікація</th>>
            <th>Дата</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody class = "qualifications-content">
            @include('admin.qualifications.paginate')
        </tbody>
    </table>

    <b>Термін наступного підтвердження: {{$user->getNextQualificationDate()}}</b>

    <div style="margin-top: 20px">
        <a href="{{route('profile.qualifications.create')}}" class="btn-block pull-left">
            <button class="btn btn-success margin-bottom">Додати</button>
        </a>
    </div>
</div>
