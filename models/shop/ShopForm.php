<?php

declare(strict_types=1);

namespace app\models\shop;

use yii\base\Model;
use yii\web\UploadedFile;

class ShopForm extends Model
{
    public ?string $name = null;
    public $image;
    public $description = null;
    public $categories;
    public ?int $status = null;
    public ?string $url = null;

    public function __construct(Shop $shop = null, $config = [])
    {
        if($shop) {
            $this->name = $shop->name;
            $this->image = $shop->image;
            $this->description = $shop->description;
            $this->categories = $shop->categories;
            $this->status = $shop->status;
            $this->url = $shop->url;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['name', 'url', 'status'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['status'], 'integer'],
            ['image', 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, jpeg, png'],
            ['url', 'url'],
            [['categories'], 'safe']
        ];
    }

    public function formName(): string
    {
        return '';
    }
}