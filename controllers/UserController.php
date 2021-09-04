<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\NotFoundException;
use app\models\user\User;
use app\models\user\CreateForm;
use app\models\user\EditForm;
use app\models\user\UserFilter;
use app\models\user\UserRepository;
use app\models\user\UserService;
use Yii;
use yii\filters\VerbFilter;
use app\security\UserIdentity;
use yii\web\Controller;
use app\models\user\LoginForm;
use yii\web\NotFoundHttpException;

class UserController extends Controller
{
    private UserService $userService;
    private UserRepository $userRepository;

    public function __construct(
        $id,
        $module,
        UserService $userService,
        UserRepository $userRepository,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->userService = $userService;
        $this->userRepository = $userRepository;
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
        $form = new UserFilter();
        $form->load(Yii::$app->request->get());
        return $this->render('index', [
            'searchModel' => $form,
            'dataProvider' => $this->userRepository->search($form),
        ]);
    }

    public function actionCreate()
    {
        $form = new CreateForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $user = $this->userService->create($form);
                return $this->redirect(['update', 'id' => $user->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }

    public function actionUpdate($id)
    {
        $user = $this->findModel($id);
        $form = new EditForm($user);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->userService->edit($user->id, $form);
                return $this->redirect(['update', 'id' => $user->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'user' => $user,
        ]);
    }

    public function actionDelete($id)
    {
        try {
            $this->userService->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $form = new LoginForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $user = $this->userService->login($form);
                Yii::$app->user->login(new UserIdentity($user), $form->rememberMe ? 3600 * 24 * 30 : 0);
                return $this->goBack();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('login', [
            'model' => $form,
        ]);
    }

    protected function findModel($id): User
    {
        try {
            return $this->userRepository->getById($id);
        } catch (NotFoundException $e) {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }
    }
}