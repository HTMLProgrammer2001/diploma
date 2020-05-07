<?php


namespace App\Repositories;


use App\InternCategory;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    private $model = InternCategory::class;

    public function getModel(): Model
    {
        return app($this->model);
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
        $category = InternCategory::query()->findOrFail($id);
        $category->fill($data);
        $category->save();

        return $category;
    }

    public function getForCombo()
    {
        return InternCategory::all('id', 'name');
    }
}
