<?php


namespace App\Services\Storage;


use App\Services\Storage\Interfaces\ImportServiceInterface;

class ImportService extends BaseStorage implements ImportServiceInterface
{
    const IMPORT_PATH = 'imports/';

    public function uploadImport($file)
    {
        return $this->upload($file, self::IMPORT_PATH);
    }

    public function getImport(string $name)
    {
        return $this->get(self::IMPORT_PATH . $name);
    }

    public function deleteImport(string $name)
    {
        return $this->delete(self::IMPORT_PATH . $name);
    }
}
