<?php

namespace App\Application\DTO;

final class UploadedFileInfo
{
    public function __construct(
        private readonly string $originalName,
        private readonly string $mimeType,
        private readonly int $size,
        private readonly string $tempPath,
        private readonly int $error
    )
    {

    }

    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    public function getType(): string
    {
        return $this->mimeType;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getTempPath(): string
    {
        return $this->tempPath;
    }

    public function getError(): int
    {
        return $this->error;
    }

    public function getBaseName(): string
    {
        $pathInfo = pathinfo('_' . $this->originalName, PATHINFO_FILENAME);
        return mb_substr($pathInfo, 1, mb_strlen($pathInfo, '8bit'), '8bit');
    }

    public function getExtension(): string
    {
        return strtolower(pathinfo($this->originalName, PATHINFO_EXTENSION));
    }


}
