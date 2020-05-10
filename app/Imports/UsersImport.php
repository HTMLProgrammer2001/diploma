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
            'commission' => $row[4],
            'department' => $row[5],
            'password' => '123456'
        ];

        return $this->userRep->create($data);
    }
}
