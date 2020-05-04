<?php


namespace App\Repositories;


use App\InternCategory;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all()
    {
        return InternCategory::all();
    }

    public function paginate(?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return InternCategory::paginate($size);
    }

    public function getForCombo()
    {
        return InternCategory::all('id', 'name');
    }
}
