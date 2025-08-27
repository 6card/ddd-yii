<?php

namespace App\Infrastructure\Auth;

use App\Domain\Model\User\User;
use App\Infrastructure\Persistence\Repository\UserRepository;

class Identity implements \yii\web\IdentityInterface
{
    public function __construct(private readonly User $user) {}

    public static function findIdentity($id)
    {
        $user = self::getRepository()->findActiveById($id);
        return $user ? new self($user) : null;
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return null;
    }

    public function getId() {
        return $this->user->getId();
    }

    public function getAuthKey() {
        return null;
    }

    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }


    private static function getRepository(): UserRepository
    {
        return \Yii::$container->get(UserRepository::class);
    }
}
