<?php

namespace App\Application\Storage;

use App\Application\DTO\UploadedFileInfo;

interface PhotoStorageInterface
{
    public function save(UploadedFileInfo $fileInfo): string;
    public function delete(string $filePath): bool;
}
