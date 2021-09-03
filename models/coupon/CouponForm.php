<?php

declare(strict_types=1);

namespace app\models\coupon;

use app\models\shop\Shop;
use yii\base\Model;

class CouponForm extends Model
{
    public ?string $name = null;
    public ?string $description = null;
    public ?int $type = null;
    public ?string $code = null;
    public ?int $shopId = null;
    public ?int $status = null;
    public ?string $startAt = null;
    public ?string $endAt = null;
    public ?string $url = null;

    public function __construct(Coupon $coupon = null, $config = [])
    {
        if ($coupon) {
            $this->name = $coupon->name;
            $this->description = $coupon->description;
            $this->type = $coupon->type;
            $this->code = $coupon->code;
            $this->shopId = $coupon->shop_id;
            $this->status = $coupon->status;
            $this->startAt = $coupon->start_at ? date('Y-m-d\TH:i', $coupon->start_at) : null;
            $this->endAt = $coupon->end_at ? date('Y-m-d\TH:i', $coupon->end_at) : null;
            $this->url = $coupon->url;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['name', 'shopId', 'type', 'status', 'url'], 'required'],
            [['shopId', 'type', 'status'], 'integer'],
            [['startAt', 'endAt'], 'string'],
            [['description'], 'string'],
            [['name', 'code'], 'string', 'max' => 180],
            [['shopId'], 'exist', 'skipOnError' => true, 'targetClass' => Shop::className(), 'targetAttribute' => ['shopId' => 'id']],
            ['code', 'required', 'when' => function ($model) {
                return $model->type == '1';
            }, 'whenClient' => "function (attribute, value) {
                return $('#couponform-type').val() == '1';
            }"],
            ['url', 'url'],
        ];
    }
}