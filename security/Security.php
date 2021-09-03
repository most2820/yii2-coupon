<?php

declare(strict_types=1);

namespace app\security;

use Yii;
use yii\base\Exception;

class Security
{
    /**
     * @throws Exception
     */
    public function generateRandomString($length = 32): string
    {
        return Yii::$app->security->generateRandomString($length);
    }

    /**
     * @throws Exception
     */
    public function generateEmailVerificationToken($length = 32): string
    {
        return Yii::$app->security->generateRandomString($length) . '_' . time();
    }

    /**
     * @throws Exception
     */
    public function generatePasswordHash($password): string
    {
        return Yii::$app->security->generatePasswordHash($password);
    }
}