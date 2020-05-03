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
        <tbody class="publication-content">
            @include('admin.publications.paginate')
        </tbody>
    </table>

    <a href="{{route('profile.publications.create')}}" class="pull-left">
        <button class="btn btn-success margin-bottom">Додати</button>
    </a>
</div>
