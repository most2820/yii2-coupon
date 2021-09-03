<?php

declare(strict_types=1);

namespace unit\models\category;

use app\models\category\Category;
use app\models\category\CategoryForm;

class CategoryFormTest extends \Codeception\Test\Unit
{
    public function testSuccess()
    {
        $model = new CategoryForm();
        $model->name = 'Tester';
        $model->status = Category::STATUS_ACTIVE;
        expect_that($model->validate());
    }
}