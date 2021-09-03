<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\category\CategoryRepository;
use app\models\NotFoundException;
use app\models\shop\Shop;
use app\models\shop\ShopFilter;
use app\models\shop\ShopForm;
use app\models\shop\ShopRepository;
use app\models\shop\ShopService;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class ShopController extends Controller
{
    private ShopService $shopService;
    private ShopRepository $shopRepository;
    private CategoryRepository $categoryRepository;

    public function __construct(
        $id,
        $module,
        ShopService $shopService,
        ShopRepository $shopRepository,
        CategoryRepository $categoryRepository,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->shopService = $shopService;
        $this->shopRepository = $shopRepository;
        $this->categoryRepository = $categoryRepository;
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

    public function actionIndex(): string
    {
        $form = new ShopFilter();
        $form->load(Yii::$app->request->get());
        return $this->render('index', [
            'searchModel' => $form,
            'dataProvider' => $this->shopRepository->search($form),
        ]);
    }

    public function actionCreate()
    {
        $form = new ShopForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $shop = $this->shopService->create($form, UploadedFile::getInstance($form, 'image'));
                return $this->redirect(['update', 'id' => $shop->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('form', [
            'model' => $form,
            'categories' => ArrayHelper::map($this->categoryRepository->getAll(), 'id', 'name'),
        ]);
    }

    public function actionUpdate($id)
    {
        $shop = $this->findModel($id);
        $form = new ShopForm($shop);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->shopService->edit($shop->id, $form, UploadedFile::getInstance($form, 'image'));
                return $this->redirect(['update', 'id' => $shop->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('form', [
            'model' => $form,
            'shop' => $shop,
            'categories' => ArrayHelper::map($this->categoryRepository->getAll(), 'id', 'name'),
        ]);
    }

    public function actionDelete($id)
    {
        try {
            $this->shopService->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect(['update', 'id' => $id]);
        }
        return $this->redirect(['index']);
    }

    protected function findModel($id): Shop
    {
        try {
            return $this->shopRepository->getById($id);
        } catch (NotFoundException $e) {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }
    }
}