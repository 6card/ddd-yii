<?php

namespace App\Domain\Model\Album;

use App\Domain\Model\Photo\Photo;
use DateTimeImmutable;

final class Album
{
    private ?int $id;
    private AlbumTitle $title;
    private ?int $coverId;
    private DateTimeImmutable $date;
    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;
    /** @var Photo[] */
    private array $photos = [];

    private function __construct(?int $id, AlbumTitle $title, DateTimeImmutable $date, ?int $coverId = null, array $photos = [], ?DateTimeImmutable $createdAt = null, ?DateTimeImmutable $updatedAt = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->coverId = $coverId;
        $this->date = $date;
        $this->createdAt = $createdAt ?? new \DateTimeImmutable();
        $this->updatedAt = $updatedAt ?? new \DateTimeImmutable();
        $this->photos = $photos;
    }

    public static function create(AlbumTitle $title, DateTimeImmutable $date)
    {
        return new self(null, $title, $date);
    }

    public function edit(AlbumTitle $title, DateTimeImmutable $date): void
    {
        $this->title = $title;
        $this->date = $date;
        $this->updatedAt = new \DateTimeImmutable();
    }

    public static function reconstitute(int $id, AlbumTitle $title, DateTimeImmutable $date, ?int $coverId, array $photos, DateTimeImmutable $createdAt, DateTimeImmutable $updatedAt): self
    {
        return new self($id, $title, $date, $coverId, $photos, $createdAt, $updatedAt);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): AlbumTitle
    {
        return $this->title;
    }

    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    public function getCoverId(): ?int
    {
        return $this->coverId;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /** @return Photo[] */
    public function getPhotos(): array
    {
        return $this->photos;
    }

    public function addPhoto(string $filename, string $url): Photo
    {
        if ($this->id === null) {
            throw new \DomainException('Cannot add photo to unsaved album.');
        }

        $photo = Photo::create($filename, $url);
        $this->photos[] = $photo;
        $this->updatedAt = new \DateTimeImmutable();
        return $photo;
    }

    public function updatePhoto(int $photoId, string $filename, string $url): void
    {
        if ($this->id === null) {
            throw new \DomainException('Cannot update photo on unsaved album.');
        }

        foreach($this->photos as $key => $photo) {
            if ($photo->getId() === $photoId) {
                $photo->update($filename, $url);

                $this->reindexPhotos();
                $this->updatedAt = new \DateTimeImmutable();
                return;
            }
        }
        throw new \DomainException('Photo with ID ' . $photoId . ' not found in album.');
    }

    public function removePhoto(int $photoId): string
    {
        foreach($this->photos as $key => $photo) {
            if ($photo->getId() === $photoId) {
                $filename = $photo->getFilename();
                unset($this->photos[$key]);

                $this->reindexPhotos();

                if ($this->photoIsCover($photoId)) {
                    $this->clearCover();
                }
                $this->updatedAt = new \DateTimeImmutable();
                return $filename;
            }
        }
        throw new \DomainException('Photo with ID ' . $photoId . ' not found in album.');
    }

    // Метод для установки ID после сохранения в репозитории
    public function setId(int $id): void
    {
        if ($this->id !== null) {
            throw new \LogicException('Album ID cannot be changed once set.');
        }
        $this->id = $id;
    }

    private function reindexPhotos(): void
    {
        $this->photos = array_values($this->photos); // переиндексация массива
    }

    public function photoIsCover(int $photoId): bool
    {
        return $this->coverId === $photoId;
    }

    public function setCover(int $photoId): void
    {
        foreach($this->photos as $key => $photo) {
            if ($photo->getId() === $photoId) {
                $this->coverId = $photoId;
                $this->updatedAt = new \DateTimeImmutable();
                return;
            }
        }
        throw new \DomainException('Photo with ID ' . $photoId . ' not found in album.');
    }

    public function getCover(): ?Photo
    {
        $photoId = $this->getCoverId();
        if ($photoId !== null) {
            foreach($this->photos as $key => $photo) {
                if ($photo->getId() === $photoId) {
                    return $photo;
                }
            }
        }
        return null;
    }

    public function clearCover(): void
    {
        $this->coverId = null;
        $this->updatedAt = new \DateTimeImmutable();
    }

    // private function reindexPhotoPositions(): void
    // {
    //     $pos = 1;
    //     $this->photos = array_map(fn(Photo $p) => $p->withPosition($pos++), $this->photos);
    // }

    // public function edit(AlbumTitle $title, DateTimeImmutable $date)
    // {
    //     $this->title = $title;
    //     $this->date = $date;
    //     $this->updatedAt = new DateTimeImmutable();
    // }
}
