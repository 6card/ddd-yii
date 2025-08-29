<?php

namespace App\Domain\Repository;

use App\Domain\Model\User\User;

interface UserRepositoryInterface
{
    public function findActiveById(int $id): ?User;
    public function findByEmail(string $email): ?User;
}
