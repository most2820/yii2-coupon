<?php

declare(strict_types=1);

namespace app\models\shop;

use app\models\category\Category;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $image
 * @property string $description
 * @property string $url
 * @property int $status
 * @property int $created_at
 *
 * @property mixed $statusLabel
 * @property CategoryAssignment[] $categoryAssignments
 * @property array $categories
 */
class Shop extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public static function tableName(): string
    {
        return '{{%shop}}';
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['categoryAssignments'],
            ],
        ];
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
        string  $name,
        ?string  $image,
        ?string $description,
        int     $status,
        string  $url
    ): self
    {
        $shop = new static();
        $shop->name = $name;
        $shop->image = $image;
        $shop->description = $description;
        $shop->status = $status;
        $shop->url = $url;
        $shop->created_at = time();
        return $shop;
    }

    public function edit(
        string  $name,
        ?string  $image,
        ?string $description,
        int     $status,
        string  $url
    ): void
    {
        $this->name = $name;
        $this->image = $image;
        $this->description = $description;
        $this->status = $status;
        $this->url = $url;
    }

    public function revokeCategories()
    {
        $this->categoryAssignments = [];
    }

    public function assignCategory(?int $categoryId)
    {
        $assignments = $this->categoryAssignments;
        $assignments[] = CategoryAssignment::create($categoryId);
        $this->categoryAssignments = $assignments;
    }

    public function getCategoryAssignments(): ActiveQuery
    {
        return $this->hasMany(CategoryAssignment::class, ['shop_id' => 'id']);
    }

    public function getCategories(): ActiveQuery
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])->via('categoryAssignments');
    }
}