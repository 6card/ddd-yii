<?php

namespace App\Infrastructure\Persistence\Repository;

use App\Domain\Model\User\User;
use App\Domain\Repository\UserRepositoryInterface;
use App\Infrastructure\Persistence\ActiveRecord\UserActiveRecord;
use App\Infrastructure\Persistence\Mapper\UserMapper;

class UserRepository implements UserRepositoryInterface
{

    public function __construct(private readonly UserMapper $userMapper) {}

    public function findActiveById(int $id): ?User
    {
        // $record = UserActiveRecord::find($id)->where(['id' => $id])->one();
        // if (!$record) {
        //     return null;
        // }
        // return $this->userMapper->toDomain($record);

        return User::reconstitute(13);
    }
}
