<?php

declare(strict_types=1);

namespace app\models\user;

use app\models\NotFoundException;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class UserRepository
{
    public function find(): ActiveQuery
    {
        return User::find();
    }

    private function getBy(array $condition): ?User
    {
        if (!$user = $this->find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('Пользователь не найден.');
        }
        return $user;
    }

    private function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider(['query' => $query]);
    }

    public function getById($id): ?User
    {
        return $this->getBy(['id' => $id]);
    }

    public function getActiveById($id): ?User
    {
        return $this->getBy(['id' => $id, 'status' => User::STATUS_ACTIVE]);
    }

    public function getByEmail($email): ?User
    {
        return $this->getBy(['email' => $email]);
    }

    public function findActiveById($id): ?User
    {
        return $this->getBy(['id' => $id, 'status' => User::STATUS_ACTIVE]);
    }

    public function findActiveByUsername($username): ?User
    {
        return $this->getBy(['username' => $username, 'status' => User::STATUS_ACTIVE]);
    }

    public function getByPasswordToken(string $token): ?User
    {
        return $this->getBy(['password_reset_token' => $token, 'status' => User::STATUS_ACTIVE]);
    }

    public function getByConfirmToken(string $token): ?User
    {
        return $this->getBy(['password_reset_token' => $token, 'status' => User::STATUS_ACTIVE]);
    }

    public function getAllByRange(int $offset, int $limit): array
    {
        return $this->find()
            ->alias('u')
            ->orderBy(['id' => SORT_ASC])
            ->limit($limit)
            ->offset($offset)
            ->all();
    }

    public function count(): int
    {
        return (int)$this->find()->count();
    }

    public function search(UserFilter $form): ActiveDataProvider
    {
        return $this->getProvider(
            $this->find()
                ->andFilterWhere(['id' => $form->id])
                ->andFilterWhere(['like', 'email', $form->email])
                ->andFilterWhere(['like', 'username', $form->username])
        );
    }

    public function save(User $user): void
    {
        if (!$user->save()) {
            throw new \RuntimeException('Ошибка сохранения пользователя.');
        }
    }

    public function remove(User $user): void
    {
        if (!$user->delete()) {
            throw new \RuntimeException('Ошибка удаления пользователя.');
        }
    }
}