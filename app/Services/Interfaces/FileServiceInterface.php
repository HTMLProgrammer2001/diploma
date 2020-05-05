<?php


namespace App\Services\Interfaces;


interface FileServiceInterface
{
    public function upload($file, string $path);

    public function get(string $path);

    public function delete(string $path);

    public function exists(string $path);
}
