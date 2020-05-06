<?php


namespace App\Repositories;


use App\Education;
use App\Repositories\Interfaces\EducationRepositoryInterface;

class EducationRepository implements EducationRepositoryInterface
{
    public function getById(int $id)
    {
        return Education::find($id);
    }

    public function create($data)
    {
        $education = new Education();

        $education->fill($data);
        $education->setUser($data['user']);
        $education->save();
    }

    public function update($id, $data)
    {
        $education = Education::findOrFail($id);
        $education->fill($data);
        $education->setUser($data['user']);
        $education->save();

        return $education;
    }

    public function destroy($id)
    {
        Education::destroy($id);
    }

    public function all()
    {
        return Education::all();
    }

    public function paginate(?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return Education::paginate($size);
    }

    public function paginateForUser($user_id, ?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return Education::query()->where('user_id', $user_id)->paginate($size);
    }
}
