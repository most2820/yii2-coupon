<?php

declare(strict_types=1);

namespace app\models\user;

use yii\base\Model;

class LoginForm extends Model
{
    public ?string $email = null;
    public ?string $password = null;
    public ?bool $rememberMe = false;

    public function rules(): array
    {
        return [
            [['email', 'password'], 'required'],
            ['rememberMe', 'boolean'],
        ];
    }

    public function formName(): string
    {
        return '';
    }
}