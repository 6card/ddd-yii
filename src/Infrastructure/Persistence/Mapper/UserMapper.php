<?php

namespace App\Infrastructure\Persistence\Mapper;

use App\Domain\Model\User\User;
use App\Infrastructure\Persistence\ActiveRecord\UserActiveRecord;

class UserMapper
{
    public function toDomain(UserActiveRecord $record): User
    {
        return User::reconstitute(
            $record->id
        );
    }

    public function toActiveRecord(User $user, UserActiveRecord $record): UserActiveRecord
    {
        if ($user->getId() > 0) {
            $record->id = $user->getId();
            $record->setIsNewRecord(false);
        }
        return $record;
    }
}
