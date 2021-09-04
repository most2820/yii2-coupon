<?php

declare(strict_types=1);

namespace app\models\category;

use app\models\NotFoundException;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class CategoryRepository
{
    public function find(): ActiveQuery
    {
        return Category::find();
    }

    private function getBy(array $condition): Category
    {
        if (!$category = $this->find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('Category is not found.');
        }
        return $category;
    }

    private function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider(['query' => $query]);
    }

    public function getById($id): Category
    {
        return $this->getBy(['id' => $id]);
    }

    public function getAll(): array
    {
        return $this->find()->all();
    }

    public function count(): string
    {
        return $this->find()->count();
    }

    public function search(CategoryFilter $form): ActiveDataProvider
    {
        return $this->getProvider(
            $this->find()
                ->andFilterWhere(['id' => $form->id])
                ->andFilterWhere(['status' => $form->status])
                ->andFilterWhere(['like', 'name', $form->name])
        );
    }

    public function save(Category $category): void
    {
        if (!$category->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Category $category): void
    {
        if (!$category->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}