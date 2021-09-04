<?php

declare(strict_types=1);

namespace app\models\coupon;

use app\models\NotFoundException;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class CouponRepository
{
    private function find(): ActiveQuery
    {
        return Coupon::find();
    }

    private function getBy(array $condition): ?Coupon
    {
        if (!$coupon = $this->find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('Coupon is not found.');
        }
        return $coupon;
    }

    public function save(Coupon $coupon): void
    {
        if (!$coupon->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Coupon $coupon): void
    {
        if (!$coupon->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function getById($id): ?Coupon
    {
        return $this->getBy(['id' => $id]);
    }

    public function search(CouponFilter $form): ActiveDataProvider
    {
        return $this->getProvider(
            $this->find()
                ->andFilterWhere(['id' => $form->id])
                ->andFilterWhere(['type' => $form->type])
                ->andFilterWhere(['status' => $form->status])
                ->andFilterWhere(['like', 'name', $form->name])
        );
    }

    private function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider(['query' => $query]);
    }

    public function count(): string
    {
        return $this->find()->count();
    }
}