<?php

namespace App\Imports;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    private $userRep, $rowNumber = 0;

    public function __construct()
    {
        $this->userRep = app(UserRepositoryInterface::class);
    }

    public function model(array $row)
    {
        $this->rowNumber++;

        if(!sizeof($row) || !$row[0] || $this->rowNumber < 2)
            return;

        $data = [
            'name' => $row[0],
            'surname' => $row[1],
            'patronymic' => $row[2],
            'email' => $row[3],
            'commission' => from_export_item($row[4])[0],
            'department' => from_export_item($row[5])[0],
            'rank' => from_export_item($row[6])[0],
            'pedagogical_title' => $row[7],
            'password' => '123456'
        ];

        return $this->userRep->create($data);
    }
}
