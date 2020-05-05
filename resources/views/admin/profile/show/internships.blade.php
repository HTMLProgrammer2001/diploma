<div class="tab-pane fade" id="internships" role="tabpanel">
    <h3>Стажування</h3>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Користувач</th>
            <th>Категорія</th>
            <th>Тема</th>
            <th>Кількість годин</th>
            <th>Дата закінчення</th>
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
