<?php

declare(strict_types=1);

namespace unit\models\shop;

use app\models\shop\Shop;
use app\models\shop\ShopForm;
use PHPUnit\Framework\TestCase;

class ShopFormTest extends TestCase
{
    public function testSuccess()
    {
        $model = new ShopForm();
        $model->name = 'Tester';
        $model->image = null;
        $model->description = null;
        $model->categories = [];
        $model->status = Shop::STATUS_ACTIVE;
        $model->url = 'http://example.com';
        expect_that($model->validate());
    }
}
