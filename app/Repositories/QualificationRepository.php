<?php


namespace App\Repositories;


use App\Qualification;
use App\Repositories\Interfaces\QualificationRepositoryInterface;
use Carbon\Carbon;

class QualificationRepository implements QualificationRepositoryInterface
{
    public function create($data)
    {
        $qualification = new Qualification();
        $qualification->fill($data);

        $qualification->setUser($data['user']);
        $qualification->save();

        return $qualification;
    }

    public function update($id, $data)
    {
        $qualification = Qualification::findOrFail($id);
        $qualification->fill($data);

        $qualification->setUser($data['user']);
        $qualification->save();

        return $qualification;
    }

    public function destroy($id)
    {
        Qualification::destroy($id);
    }

    public function all()
    {
        return Qualification::all();
    }

    public function paginate(?int $size)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return Qualification::paginate($size);
    }

    public function getQualificationNames(): array
    {
        return Qualification::getQualificationNames();
    }

    public function getLastQualificationDateOf(int $user_id): string
    {
        $date = Qualification::query()->where('user_id', $user_id)
            ->orderBy('date', 'desc')->pluck('date')->first();

        return $date ?? null;
    }

    public function getNextQualificationDateOf(int $user_id): string
    {
        $lastDate = $this->getLastQualificationDateOf($user_id);

        if(!$lastDate)
            return null;

        return Carbon::createFromFormat('Y-m-d', $lastDate)
                ->addYears(5)->format('Y-m-d');
    }

    public function getQualificationNameOf(int $user_id): string
    {
        $name = Qualification::query()->where('user_id', $user_id)
            ->orderBy('date', 'desc')->pluck('name')->first();

        return $name ?? null;
    }
}
