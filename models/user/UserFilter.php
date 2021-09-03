<?php

declare(strict_types=1);

namespace app\models\user;

use yii\base\Model;

class UserFilter extends Model
{
    public $id;
    public $username;
    public $email;
    public $status;

    public function rules(): array
    {
        return [
            [['username', 'email', 'phone'], 'string'],
            [['id', 'status'], 'integer'],
        ];
    }

    public function formName(): string
    {
        return '';
    }
}