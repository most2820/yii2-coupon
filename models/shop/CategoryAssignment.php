<?php

declare(strict_types=1);

namespace app\models\shop;

use yii\db\ActiveRecord;

/**
 * @property int $shop_id
 * @property int $category_id
 */
class CategoryAssignment extends ActiveRecord
{
    public static function primaryKey(): array
    {
        return ['shop_id'];
    }

    public static function tableName(): string
    {
        return '{{%category_assignment}}';
    }

    public static function create(int $categoryId) : self
    {
        $discountAssignment = new static();
        $discountAssignment->category_id = $categoryId;
        return $discountAssignment;
    }
}