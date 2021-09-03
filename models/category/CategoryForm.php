<?php

declare(strict_types=1);

namespace app\models\category;

use yii\base\Model;

class CategoryForm extends Model
{
    public ?string $name = null;
    public ?int $status = null;

    public function __construct(Category $category = null, $config = [])
    {
        if ($category) {
            $this->name = $category->name;
            $this->status = $category->status;
        }
        parent::__construct($config);

    }

    public function formName(): string
    {
        return '';
    }

    public function rules(): array
    {
        return [
            [['name', 'status'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['status'], 'integer'],
        ];
    }
}