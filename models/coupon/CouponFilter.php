<?php

declare(strict_types=1);

namespace app\models\coupon;

use app\models\shop\Shop;
use yii\base\Model;

class CouponFilter extends Model
{
    public $id;
    public $name;
    public $type;
    public $status;

    public function rules(): array
    {
        return [
            [['name'], 'string'],
            [['id', 'status', 'type', 'sort'], 'integer'],
        ];
    }

    public function formName(): string
    {
        return '';
    }
}