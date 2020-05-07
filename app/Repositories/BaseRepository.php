<?php


namespace App\Repositories;


use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    //method that return class of repository model
    abstract public function getModel(): Model;

    public function destroy($id)
    {
        //destroy model
        return $this->getModel()->destroy($id);
    }

    public function getById(int $id)
    {
        //find model by id
        return $this->getModel()->find($id);
    }

    public function paginate(?int $size = null)
    {
        //return pagination without filters
        return $this->filterPaginate([], $size);
    }

    public function filterPaginate(array $rules, ?int $size = null)
    {
        //create query builder
        $query = $this->getModel()->query();

        //apply all rules
        foreach ($rules as $rule)
            $query = $rule->apply($query);

        //set size of pagination
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        //return pagination
        return $query->paginate($size);
    }
}
