<?php


namespace App\Repositories\Interfaces;


interface BaseRepositoryInterface
{
    public function create($data);

    public function update($id, $data);

    public function destroy($id);

    public function paginate(?int $size);
}
