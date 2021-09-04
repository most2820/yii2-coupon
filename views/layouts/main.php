<?php

declare(strict_types=1);

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AdminLteAsset;
use app\assets\AutosizeTextareaAsset;
use app\assets\FontAwesomeAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

AdminLteAsset::register($this);
FontAwesomeAsset::register($this);
AutosizeTextareaAsset::register($this);

$csrfParam = Yii::$app->request->csrfParam;
$csrfToken = Yii::$app->request->csrfToken;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="sidebar-mini layout-boxed">
<?php $this->beginBody() ?>
<div class="wrapper">
    <div class="main-header navbar navbar-expand navbar-white navbar-light">
        <?= Menu::widget([
            'encodeLabels' => false,
            'options' => [
                'class' => 'navbar-nav'
            ],
            'itemOptions' => [
                'class' => 'nav-item'
            ],
            'linkTemplate' => '{label}',
            'items' => [
                [
                    'label' => Html::a('<i class="fas fa-bars"></i>', '#', [
                        'class' => 'nav-link',
                        'data-widget' => 'pushmenu',
                        'role' => 'button'
                    ]),
                ],
                Yii::$app->user->isGuest ? ([
                    'label' => Html::a('Login', ['user/login'], [
                        'class' => 'nav-link',
                    ]),
                ]) : ([
                    'url' => ['/user/logout'],
                    'label' => 'Logout',
                    'template' => <<<HTML
<form method="post" action="{url}">
<input type="hidden" name="{$csrfParam}" value="{$csrfToken}" />
<input type="submit" class="btn nav-link" value="{label}" />
</form>
HTML
                    ,
                ]
                ),
            ]
        ]); ?>
    </div>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="<?= Url::to(['/admin']) ?>" class="brand-link">
            <img src="/logo.png" alt="<?= Yii::$app->name ?>"
                 class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light"><?= Yii::$app->name ?></span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <?= Menu::widget([
                    'encodeLabels' => false,
                    'options' => [
                        'class' => 'nav nav-pills nav-sidebar flex-column',
                        'data-widget' => 'treeview',
                        'role' => 'menu'
                    ],
                    'itemOptions' => [
                        'class' => 'nav-item'
                    ],
                    'linkTemplate' => '<a class="nav-link" href="{url}">{label}</a>',
                    'submenuTemplate' => "\n<ul class='nav nav-treeview'>\n{items}\n</ul>\n",
                    'activateParents' => true,
                    'items' => [
                        [
                            'label' => '<i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>',
                            'url' => ['dashboard/index'],
                            'active' => Yii::$app->controller->id === 'dashboard'
                        ],
                        [
                            'label' => '<i class="nav-icon fab fa-microsoft"></i><p>Categories</p>',
                            'url' => ['category/index'],
                            'active' => Yii::$app->controller->id === 'category'
                        ],
                        [
                            'label' => '<i class="nav-icon fab fa-shopify"></i><p>Shops</p>',
                            'url' => ['shop/index'],
                            'active' => Yii::$app->controller->id === 'shop',
                        ],
                        [
                            'label' => '<i class="nav-icon fab fa-cc-discover"></i><p>Coupons</p>',
                            'url' => ['coupon/index'],
                            'active' => Yii::$app->controller->id === 'coupon',
                        ],
                        [
                            'label' => '<i class="nav-icon fas fa-users"></i><p>Users</p>',
                            'url' => ['user/index'],
                            'active' => Yii::$app->controller->id === 'user'
                        ],
                    ],
                ]); ?>

            </nav>
        </div>
    </aside>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><?= Html::encode($this->title) ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <?= Breadcrumbs::widget([
                            'homeLink' => [
                                'label' => '<i class="fa fa-home"></i>',
                                'encode' => false,
                                'url' => Url::home(),
                            ],
                            'options' => [
                                'class' => 'breadcrumb float-sm-right',
                                'tag' => 'ol'
                            ],
                            'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>\n",
                            'links' => $this->params['breadcrumbs'] ?? [],
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </section>
    </div>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.0
        </div>
        <strong><?= Yii::$app->name ?> © <?= Yii::$app->formatter->asDate(time(), 'Y') ?> </strong>
    </footer>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
