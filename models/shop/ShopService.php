<?php

declare(strict_types=1);

namespace app\models\shop;

use app\services\ImageManager;
use app\services\TransactionManager;
use yii\web\UploadedFile;

class ShopService
{
    private ShopRepository $shopRepository;
    private TransactionManager $transactionManager;
    private ImageManager $imageManager;

    public function __construct(
        ShopRepository     $shopRepository,
        TransactionManager $transactionManager,
        ImageManager       $imageManager
    )
    {
        $this->shopRepository = $shopRepository;
        $this->transactionManager = $transactionManager;
        $this->imageManager = $imageManager;
    }

    public function create(ShopForm $form, ?UploadedFile $file): Shop
    {
        $shop = Shop::create(
            $form->name,
            $file ? $this->imageManager->upload($file) : null,
            $form->description,
            $form->status,
            $form->url
        );
        $this->transactionManager->wrap(function () use ($shop, $form) {
            if (!empty($form->categories)) {
                foreach ($form->categories as $categoryId) {
                    $shop->assignCategory((int)$categoryId);
                }
            }
            $this->shopRepository->save($shop);
        });
        return $shop;
    }

    public function edit($id, ShopForm $form, ?UploadedFile $file): Shop
    {
        $shop = $this->shopRepository->getById($id);
        $shop->edit(
            $form->name,
            $file ? $this->imageManager->upload($file) : $shop->image,
            $form->description,
            $form->status,
            $form->url
        );
        $this->transactionManager->wrap(function () use ($shop, $form) {
            $shop->revokeCategories();
            $this->shopRepository->save($shop);
            if (!empty($form->categories)) {
                foreach ($form->categories as $categoryId) {
                    $shop->assignCategory((int)$categoryId);
                }
            }
            $this->shopRepository->save($shop);
        });
        return $shop;
    }

    public function remove($id): void
    {
        $category = $this->shopRepository->getById($id);
        $this->shopRepository->remove($category);
    }
}