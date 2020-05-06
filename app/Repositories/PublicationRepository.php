<?php


namespace App\Repositories;


use App\Publication;
use App\Repositories\Interfaces\PublicationRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PublicationRepository implements PublicationRepositoryInterface
{
    public function getById(int $id)
    {
        return Publication::find($id);
    }

    public function create($data)
    {
        $publication = new Publication();
        $publication->fill($data);
        $publication->save();

        $publication->setAuthors($data['authors']);
        $publication->save();

        return $publication;
    }

    public function update($id, $data)
    {
        $publication = Publication::findOrFail($id);
        $publication->fill($data);
        $publication->save();

        $publication->setAuthors($data['authors']);
        $publication->save();

        return $publication;
    }

    public function destroy($id)
    {
        Publication::destroy($id);
    }

    public function all()
    {
        return Publication::all();
    }

    public function paginate(?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE');

        return Publication::paginate($size);
    }

    public function paginateForUser($user_id, ?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return Publication::query()->whereHas('authors', function ($q) use($user_id){
            $q->where('user_id', $user_id);
        })->paginate($size);
    }
}
