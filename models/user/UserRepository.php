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
            throw new NotFoundException('User is not found.');
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

    public function count(): string
    {
        return $this->find()->count();
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
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(User $user): void
    {
        if (!$user->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function getByEmail($email): ?User
    {
        return $this->getBy(['email' => $email]);
    }
}