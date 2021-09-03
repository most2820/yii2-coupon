<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\category\Category;
use app\models\category\CategoryFilter;
use app\models\category\CategoryForm;
use app\models\category\CategoryRepository;
use app\models\category\CategoryService;
use app\models\NotFoundException;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CategoryController extends Controller
{
    private CategoryService $categoryService;
    private CategoryRepository $categoryRepository;

    public function __construct(
        $id,
        $module,
        CategoryService $categoryService,
        CategoryRepository $categoryRepository,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->categoryService = $categoryService;
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
        $form = new CategoryFilter();
        $form->load(Yii::$app->request->get());
        return $this->render('index', [
            'searchModel' => $form,
            'dataProvider' => $this->categoryRepository->search($form),
        ]);
    }

    public function actionCreate()
    {
        $form = new CategoryForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $category = $this->categoryService->create($form);
                return $this->redirect(['update', 'id' => $category->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('form', [
            'model' => $form,
        ]);
    }

    public function actionUpdate($id)
    {
        $category = $this->findModel($id);
        $form = new CategoryForm($category);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->categoryService->edit($category->id, $form);
                return $this->redirect(['update', 'id' => $category->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('form', [
            'model' => $form,
            'category' => $category,
        ]);
    }

    public function actionDelete($id)
    {
        try {
            $this->categoryService->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect(['update', 'id' => $id]);
        }
        return $this->redirect(['index']);
    }

    protected function findModel($id): Category
    {
        try {
            return $this->categoryRepository->getById($id);
        } catch (NotFoundException $e) {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }
    }
}