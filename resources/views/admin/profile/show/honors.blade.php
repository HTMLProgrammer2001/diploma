<div class="tab-pane fade" id="honors" role="tabpanel">
    <h3>Нагороди</h3>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Викладач</th>
            <th>Назва нагороди</th>
            <th>Дата видачі</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody class="honors-content">
            @include('admin.honors.paginate')
        </tbody>
    </table>
</div>
