<?php

namespace App\Application\Service;

use App\Application\Command\AddPhotoCommand;
use App\Application\Command\AddPhotosCommand;
use App\Application\Command\ClearCoverCommand;
use App\Application\Command\CreateAlbumCommand;
use App\Application\Command\DeleteAlbumCommand;
use App\Application\Command\RemovePhotoCommand;
use App\Application\Command\SetCoverCommand;
use App\Application\Command\UpdateAlbumCommand;
use App\Application\Command\UpdatePhotoCommand;
use App\Application\Command\UserSignInCommand;
use App\Domain\Model\Album\Album;
use App\Domain\Model\Album\AlbumTitle;
use App\Domain\Model\User\User;
use App\Domain\Repository\UserRepositoryInterface;
use App\Infrastructure\Auth\Identity;

class AuthService
{
    public function __construct(private readonly UserRepositoryInterface $userRepository) {}

    public function signIn(UserSignInCommand $command): User
    {
        $user = $this->userRepository->findByEmail($command->email);
        if (!$user || !$user->validatePassword($command->password)) {
            throw new \DomainException('Undefined user or password.');
        }

        return $user;
    }
}
