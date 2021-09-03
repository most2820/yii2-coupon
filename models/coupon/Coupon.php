<?php

declare(strict_types=1);

namespace app\models\coupon;

use app\models\shop\Shop;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property integer $type
 * @property string $code
 * @property int $status
 * @property int $shop_id
 * @property int $start_at
 * @property int $end_at
 * @property string $url
 * @property integer $created_at
 */
class Coupon extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    const TYPE_COUPON = 1;
    const TYPE_ACTION = 2;

    public static function tableName(): string
    {
        return 'coupon';
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


    public static function getTypes(): array
    {
        return [
            self::TYPE_COUPON => 'Coupon',
            self::TYPE_ACTION => 'Action',
        ];
    }

    public function getTypeLabel(): ?string
    {
        return ArrayHelper::getValue(self::getTypes(), $this->type);
    }

    public static function create(
        string  $name,
        ?string $description,
        int     $type,
        ?string $code,
        int     $shopId,
        ?string $startAt,
        ?string $endAt,
        ?string $url,
        int     $status
    ): Coupon
    {
        $category = new static();
        $category->name = $name;
        $category->type = $type;
        $category->code = $code;
        $category->shop_id = $shopId;
        $category->start_at = $startAt ? strtotime($startAt) : null;
        $category->end_at = $endAt ? strtotime($endAt) : null;
        $category->url = $url;
        $category->status = $status;
        $category->created_at = time();
        return $category;
    }

    public function getShop(): ActiveQuery
    {
        return $this->hasOne(Shop::className(), ['id' => 'shop_id']);
    }

    public function edit(
        string  $name,
        ?string $description,
        int     $type,
        ?string $code,
        int     $shopId,
        ?string $startAt,
        ?string $endAt,
        ?string $url,
        int     $status
    ): void
    {
        $this->name = $name;
        $this->description = $description;
        $this->type = $type;
        $this->name = $name;
        $this->code = $code;
        $this->shop_id = $shopId;
        $this->start_at = $startAt ? strtotime($startAt) : null;;
        $this->end_at = $endAt ? strtotime($endAt) : null;
        $this->url = $url;
        $this->status = $status;
    }
}