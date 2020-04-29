<div class="tab-pane fade active in" id="publications" role="tabpanel"
     aria-labelledby="home-tab">
    <h3>Публікації</h3>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Назва</th>
            <th>Автори</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody id="publications_content"></tbody>
    </table>

    <div class="pull-right" id="publications_paginate">
        {{$publications->onEachSide(5)->links()}}
    </div>

    <a href="{{route('profile.publications.create')}}" class="pull-left">
        <button class="btn btn-success margin-bottom">Додати</button>
    </a>
</div>
