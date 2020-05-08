<?php


namespace App\Services\Storage\Interfaces;


interface ImportServiceInterface
{
    public function uploadImport($file);

    public function getImport(string $name);

    public function deleteImport(string $name);
}
