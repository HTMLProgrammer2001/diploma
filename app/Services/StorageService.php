<?php


namespace App\Services;


use App\Services\Interfaces\FileServiceInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StorageService implements FileServiceInterface
{
    public function upload($file, string $path){
        if(!$file)
            return null;

        $newFileName = Str::random(16) . '.' . $file->extension();

        $file->storeAs($path, $newFileName);

        return $newFileName;
    }

    public function get(string $path){
        if(Storage::exists($path))
            return Storage::get($path);
    }

    public function delete(string $path){
        if(Storage::exists($path))
            return Storage::delete($path);
    }

    public function exists($path){
        return Storage::exists($path);
    }
}
