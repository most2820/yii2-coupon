<?php

declare(strict_types=1);

namespace app\models\category;

use yii\base\Model;

class CategoryFilter extends Model
{
    public $id;
    public $name;
    public $status;

    public function rules(): array
    {
        return [
            [['name'], 'string'],
            [['id', 'status'], 'integer'],
        ];
    }

    public function formName(): string
    {
        return '';
    }
}