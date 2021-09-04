<?php

declare(strict_types=1);

namespace app\models\shop;

use app\models\NotFoundException;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class ShopRepository
{
    private function find(): ActiveQuery
    {
        return Shop::find();
    }

    private function getBy(array $condition): ?Shop
    {
        if (!$shop = $this->find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('Shop is not found.');
        }
        return $shop;
    }

    public function save(Shop $shop): void
    {
        if (!$shop->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Shop $shop): void
    {
        if (!$shop->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function getById($id): ?Shop
    {
        return $this->getBy(['id' => $id]);
    }

    public function search(ShopFilter $form)
    {
        return $this->getProvider(
            $this->find()
                ->andFilterWhere(['id' => $form->id])
                ->andFilterWhere(['status' => $form->status])
                ->andFilterWhere(['like', 'name', $form->name])
        );
    }

    private function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider(['query' => $query]);
    }

    public function getActiveAll(): ActiveDataProvider
    {
        return $this->getProvider(
            $this->find()
                ->where(['status' => Shop::STATUS_ACTIVE])
        );
    }

    public function getAllByNameRange(string $name, int $offset, int $limit): array
    {
        return $this->find()
            ->alias('s')
            ->where(['like', 'name', $name])
            ->orderBy(['id' => SORT_ASC])
            ->limit($limit)
            ->offset($offset)
            ->all();
    }

    public function getAllByRange(int $offset, int $limit): array
    {
        return $this->find()
            ->alias('s')
            ->orderBy(['id' => SORT_ASC])
            ->limit($limit)
            ->offset($offset)
            ->all();
    }

    public function count(): string
    {
        return $this->find()->count();
    }
}