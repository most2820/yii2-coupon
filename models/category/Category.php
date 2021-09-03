<?php

declare(strict_types=1);

namespace app\models\category;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property int $id
 * @property string $name
 * @property int $status
 * @property int $created_at
 */
class Category extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public static function tableName(): string
    {
        return '{{%category}}';
    }

    public static function getStatuses(): array
    {
        return [
            self::STATUS_INACTIVE => 'Inactive',
            self::STATUS_ACTIVE => 'Active',
        ];
    }

    public function getStatusLabel(): ?string
    {
        return ArrayHelper::getValue(self::getStatuses(), $this->status);
    }

    public static function create(
        string $name,
        int    $status
    ): Category
    {
        $category = new static();
        $category->name = $name;
        $category->status = $status;
        $category->created_at = time();
        return $category;
    }

    public function edit(
        string $name,
        int    $status
    ): void
    {
        $this->name = $name;
        $this->status = $status;
    }
}