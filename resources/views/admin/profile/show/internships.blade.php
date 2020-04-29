<div class="tab-pane fade" id="internships" role="tabpanel">
    <h3>Стажування</h3>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Тема</th>
            <th>Місце</th>
            <th>Дата кінця</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody id="internships_content"></tbody>
    </table>

    <b>Годин з останнього підвищення кваліфікації: {{$user->getInternshipHours()}}</b>

    <div class="pull-right paginator" id="internships_paginate">
        {{$internships->onEachSide(5)->links()}}
    </div>

    <a href="{{route('profile.internships.create')}}" class="btn-block pull-left" style="margin-top: 20px">
        <button class="btn btn-success margin-bottom">Додати</button>
    </a>
</div>
