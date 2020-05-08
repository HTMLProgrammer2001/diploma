<?php


namespace App\Repositories\Interfaces;


interface BaseRepositoryInterface
{
    public function create($data);

    public function update($id, $data);

    public function destroy($id);

    public function getById(int $id);

    public function paginate(?int $size);

    public function filterPaginate(array $rules, ?int $size = null);
}
