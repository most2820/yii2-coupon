<?php

declare(strict_types=1);

namespace app\models\user;

use yii\base\Model;

class SignupForm extends Model
{
    public ?string $username = null;
    public ?string $email = null;
    public ?string $password = null;

    public function rules(): array
    {
        return [
            [['username', 'email', 'password'], 'required'],
            [['username', 'email'], 'string', 'max' => 255],
            [['username', 'email'], 'trim'],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'Этот логин уже занят.'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'Этот адрес электронной почты уже занят.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function formName(): string
    {
        return '';
    }

    public function attributeLabels(): array
    {
        return [
            'username' => 'Логин',
            'email' => 'E-mail',
            'password' => 'Пароль',
        ];
    }
}