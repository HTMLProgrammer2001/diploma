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
        <tbody id="rebukes_content"></tbody>
    </table>

    <div style="margin-top: 20px">
        <div class="pull-right paginator" id="rebukes_paginate">
            {{$rebukes->onEachSide(5)->links()}}
        </div>
    </div>
</div>
