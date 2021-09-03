<?php

declare(strict_types=1);

namespace app\models\user;

use yii\base\Model;

class CreateForm extends Model
{
    public ?string $username = null;
    public ?string $email = null;
    public bool $sendEmail = true;

    public function rules(): array
    {
        return [
            [['username', 'email', 'sendEmail'], 'required'],
            [['username', 'email'], 'trim'],
            [['username', 'email'], 'string', 'max' => 255],
            [['sendEmail'], 'boolean'],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'This login is already taken.'],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'This email address is already taken.'],
        ];
    }

    public function formName(): string
    {
        return '';
    }
}