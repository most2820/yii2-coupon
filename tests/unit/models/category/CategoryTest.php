<?php

declare(strict_types=1);

namespace unit\models\category;

use app\models\category\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testSuccess()
    {
        $category = Category::create(
            $name = 'Name',
            $status = Category::STATUS_ACTIVE,
        );
        $this->assertEquals($name, $category->name);
        $this->assertEquals($status, $category->status);
    }
}
