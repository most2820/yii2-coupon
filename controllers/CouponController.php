<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\coupon\Coupon;
use app\models\coupon\CouponFilter;
use app\models\coupon\CouponForm;
use app\models\coupon\CouponRepository;
use app\models\coupon\CouponService;
use app\models\NotFoundException;
use app\models\shop\ShopRepository;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CouponController extends Controller
{
    private CouponService $couponService;
    private CouponRepository $couponRepository;
    private ShopRepository $shopRepository;

    public function __construct(
        $id,
        $module,
        CouponService $couponService,
        CouponRepository $couponRepository,
        ShopRepository $shopRepository,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->couponService = $couponService;
        $this->couponRepository = $couponRepository;
        $this->shopRepository = $shopRepository;
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action): bool
    {
        if ($action->id == 'shop-autocomplete') {
            \Yii::$app->response->format = Response::FORMAT_JSON;
        }
        return parent::beforeAction($action);
    }

    public function actionIndex(): string
    {
        $form = new CouponFilter();
        $form->load(Yii::$app->request->get());
        return $this->render('index', [
            'searchModel' => $form,
            'dataProvider' => $this->couponRepository->search($form),
        ]);
    }

    public function actionCreate()
    {
        $form = new CouponForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $coupon = $this->couponService->create($form);
                Yii::$app->session->setFlash('success', 'Успешно сохранено');
                return $this->redirect(['update', 'id' => $coupon->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('form', [
            'model' => $form,
            'shops' => ArrayHelper::map($this->shopRepository->getAllByRange(0, 20), 'id', 'name')
        ]);
    }

    public function actionUpdate($id)
    {
        $coupon = $this->findModel($id);
        $form = new CouponForm($coupon);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->couponService->edit($coupon->id, $form);
                Yii::$app->session->setFlash('success', 'Успешно сохранено');
                return $this->redirect(['update', 'id' => $coupon->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('form', [
            'model' => $form,
            'coupon' => $coupon,
            'shops' => ArrayHelper::map($this->shopRepository->getAllByRange(0, 20), 'id', 'name'),
        ]);
    }

    public function actionDelete($id): Response
    {
        try {
            $this->couponService->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect(['update', 'id' => $id]);
        }
        return $this->redirect(['index']);
    }

    public function actionShopAutocomplete($q = null, $id = null): array
    {
        try {
            if (!is_null($q)) {
                return ['results' => $this->shopRepository->getAllByNameRange($q, 0, 20)];
            }
            return ['results' => [$id => $this->shopRepository->getById($id)]];
        } catch (NotFoundException $e) {
            return ['results' => []];
        }
    }

    protected function findModel($id): Coupon
    {
        try {
            return $this->couponRepository->getById($id);
        } catch (NotFoundException $e) {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }
    }
}