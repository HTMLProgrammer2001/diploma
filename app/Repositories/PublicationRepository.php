<?php


namespace App\Repositories;


use App\Publication;
use App\Repositories\Interfaces\PublicationRepositoryInterface;

class PublicationRepository implements PublicationRepositoryInterface
{
    public function create($data)
    {
        $publication = new Publication();
        $publication->fill($data);
        $publication->setAuthors($data['authors']);
        $publication->save();

        return $publication;
    }

    public function update($id, $data)
    {
        $publication = Publication::findOrFail($id);
        $publication->fill($data);
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
}
