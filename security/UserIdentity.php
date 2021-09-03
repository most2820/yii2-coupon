<?php

declare(strict_types=1);

namespace app\security;

use app\models\user\User;
use yii\web\IdentityInterface;

class UserIdentity implements IdentityInterface
{
    private User $_user;

    public function __construct(User $user)
    {
        $this->_user = $user;
    }

    public static function findIdentity($id): ?UserIdentity
    {
        $user = User::findOne(['id' => $id, 'status' => User::STATUS_ACTIVE]);
        return $user ? new self($user): null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new \DomainException('Найти идентификацию по токену доступа не реализовано.');
    }

    public function getId(): ?int
    {
        return $this->_user->getPrimaryKey();
    }

    public function getAuthKey(): ?string
    {
        return $this->_user->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    public function __get($name)
    {
        return $this->_user->$name;
    }

    public function __call($methodName, $args)
    {
        return $this->_user->$methodName($args);
    }
}