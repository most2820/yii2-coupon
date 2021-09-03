<?php

declare(strict_types=1);

namespace app\models\user;

use yii\base\Model;

class EditForm extends Model
{
    public ?string $username = null;
    public ?string $email = null;
    public ?int $status = null;
    public User $_user;

    public function __construct(
        User $user,
        $config = []
    )
    {
        $this->username = $user->username;
        $this->email = $user->email;
        $this->status = $user->status;
        $this->_user = $user;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['username', 'email'], 'required'],
            [['username', 'email', 'email'], 'trim'],
            ['email', 'email'],
            [['username'], 'string', 'max' => 255],
            [['status'], 'integer'],
            [['username', 'email'], 'unique', 'targetClass' => User::class, 'filter' => ['<>', 'id', $this->_user->id]],
        ];
    }

    public function formName(): string
    {
        return '';
    }
}