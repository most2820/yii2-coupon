<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\category\CategoryRepository;
use app\models\coupon\CouponRepository;
use app\models\shop\ShopRepository;
use app\models\user\UserRepository;
use yii\web\Controller;

class DashboardController extends Controller
{
    private UserRepository $userRepository;
    private ShopRepository $shopRepository;
    private CouponRepository $couponRepository;
    private CategoryRepository $categoryRepository;

    public function __construct(
        $id,
        $module,
        UserRepository $userRepository,
        ShopRepository $shopRepository,
        CouponRepository $couponRepository,
        CategoryRepository $categoryRepository,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->userRepository = $userRepository;
        $this->shopRepository = $shopRepository;
        $this->couponRepository = $couponRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'categoryCount' => $this->categoryRepository->count(),
            'shopCount' => $this->shopRepository->count(),
            'couponCount' => $this->couponRepository->count(),
            'userCount' => $this->userRepository->count(),
        ]);
    }
}