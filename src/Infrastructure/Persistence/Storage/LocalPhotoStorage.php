<?php

namespace App\Infrastructure\Persistence\Storage;

use App\Application\DTO\UploadedFileInfo;
use App\Application\Storage\PhotoStorageInterface;

class LocalPhotoStorage implements PhotoStorageInterface
{
    public function __construct(private readonly string $targetDirectory)
    {

    }
    public function save(UploadedFileInfo $fileInfo): string
    {
        $tempFilePath = $fileInfo->getTempPath();

        $targetFileName = $this->generateFileName($fileInfo);
        $targetPath = $this->getTargetPath($targetFileName);

        if (!move_uploaded_file($tempFilePath, $targetPath)) {
            throw new \RuntimeException("File save error");
        }
        return $targetFileName;
    }
    public function delete(string $targetFileName): bool
    {
        $targetPath = $this->getTargetPath($targetFileName);
        return @unlink($targetPath);
    }

    private function generateFileName(UploadedFileInfo $fileInfo): string
    {
        return uniqid("p_") . '.' . $fileInfo->getExtension(); // Generate a unique name
    }

    private function getTargetPath($targetFileName): string
    {
        return $this->targetDirectory . DIRECTORY_SEPARATOR . $targetFileName;
    }
}
