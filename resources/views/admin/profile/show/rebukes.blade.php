<div class="tab-pane fade" id="rebukes" role="tabpanel">
    <h3>Догани</h3>

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
