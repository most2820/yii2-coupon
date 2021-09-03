<?php

declare(strict_types=1);

namespace app\models\user;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property int $id
 * @property string $username
 * @property string $email
 * @property int $status
 * @property string $auth_key
 * @property string $verification_token
 * @property string $password_hash
 * @property string $password_reset_token
 * @property int $created_at
 * @property int $updated_at
 */
class User extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public static function tableName(): string
    {
        return '{{%user}}';
    }

    public static function getStatuses(): array
    {
        return [
            self::STATUS_INACTIVE => 'Inactive',
            self::STATUS_ACTIVE => 'Active',
        ];
    }

    public function getStatusLabel(): ?string
    {
        return ArrayHelper::getValue(self::getStatuses(), $this->status);
    }

    public static function create(
        string $username,
        string $email,
        string $auth_key,
        string $verification_token,
        string $password_hash
    ): User
    {
        $user = new static();
        $user->username = $username;
        $user->email = $email;
        $user->status = self::STATUS_ACTIVE;
        $user->auth_key = $auth_key;
        $user->verification_token = $verification_token;
        $user->password_hash = $password_hash;
        $user->created_at = time();
        $user->updated_at = time();
        return $user;
    }

    public function edit(
        string  $username,
        string $email,
        int     $status
    ): void
    {
        $this->username = $username;
        $this->email = $email;
        $this->status = $status;
    }
}