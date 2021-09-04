<?php

declare(strict_types=1);

namespace app\security;

use Yii;

class Security
{
    public function generateRandomString($length = 32): string
    {
        return Yii::$app->security->generateRandomString($length);
    }

    public function generateEmailVerificationToken($length = 32): string
    {
        return Yii::$app->security->generateRandomString($length) . '_' . time();
    }

    public function generatePasswordHash($password): string
    {
        return Yii::$app->security->generatePasswordHash($password);
    }

    public function validatePassword($password, $password_hash): bool
    {
        return Yii::$app->security->validatePassword($password, $password_hash);
    }
}