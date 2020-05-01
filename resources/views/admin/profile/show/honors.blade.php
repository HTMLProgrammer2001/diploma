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
        <tbody id="honors_content"></tbody>
    </table>

    <div style="margin-top: 20px">
        <div class="pull-right paginator" id="honors_paginate">
            {{$honors->onEachSide(5)->links()}}
        </div>
    </div>
</div>
