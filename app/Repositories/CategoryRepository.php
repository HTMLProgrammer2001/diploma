<?php


namespace App\Repositories;


use App\InternCategory;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getById(int $id)
    {
        return InternCategory::find($id);
    }

    public function create($data)
    {
        $category = new InternCategory();
        $category->fill($data);
        $category->save();

        return $category;
    }

    public function update($id, $data)
    {
        $category = InternCategory::findOrFail($id);
        $category->fill($data);
        $category->save();

        return $category;
    }

    public function destroy($id)
    {
        InternCategory::destroy($id);
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
