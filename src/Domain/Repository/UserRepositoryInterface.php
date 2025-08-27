<?php

namespace App\Domain\Repository;

use App\Domain\Model\User\User;

interface UserRepositoryInterface
{
    public function findActiveById(int $id): ?User;
}
