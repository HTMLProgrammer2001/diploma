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
        $category = $this->getModel()->query()->newModelInstance($data);
        $category->save();

        return $category;
    }

    public function update($id, $data)
    {
        $category = $this->getModel()->query()->findOrFail($id);
        $category->fill($data);
        $category->save();

        return $category;
    }

    public function getForCombo()
    {
        return $this->getModel()->all('id', 'name');
    }

    public function getForExportList(): array
    {
        return to_export_list($this->getModel()->all('id', 'name')->toArray());
    }
}
