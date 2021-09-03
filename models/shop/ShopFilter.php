<?php

declare(strict_types=1);

namespace app\models\shop;

use yii\base\Model;

class ShopFilter extends Model
{
    public $id;
    public $name;
    public $status;

    public function rules(): array
    {
        return [
            [['name'], 'string'],
            [['id', 'status', 'sort'], 'integer'],
        ];
    }

    public function formName(): string
    {
        return '';
    }
}