<?php

declare(strict_types=1);

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= number_format($categoryCount, 0, '', '') ?></h3>
                <p>Categories</p>
            </div>
            <div class="icon">
                <i class="fab fa-microsoft"></i>
            </div>
            <?= Html::a(
                    'More info ' . Html::tag('i', '', ['class' => 'fas fa-arrow-circle-right']),
                ['category/index'],
                ['class' => 'small-box-footer']
            ) ?>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= number_format($shopCount, 0, '', '') ?></h3>
                <p>Shops</p>
            </div>
            <div class="icon">
                <i class="fab fa-shopify"></i>
            </div>
            <?= Html::a(
                    'More info ' . Html::tag('i', '', ['class' => 'fas fa-arrow-circle-right']),
                ['shop/index'],
                ['class' => 'small-box-footer']
            ) ?>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= number_format($userCount, 0, '', '') ?></h3>
                <p>Coupons</p>
            </div>
            <div class="icon">
                <i class="fab fa-cc-discover"></i>
            </div>
            <?= Html::a(
                    'More info ' . Html::tag('i', '', ['class' => 'fas fa-arrow-circle-right']),
                ['coupon/index'],
                ['class' => 'small-box-footer']
            ) ?>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= number_format($userCount, 0, '', '') ?></h3>
                <p>Users</p>
            </div>
            <div class="icon">
                <i class="fas fa-user"></i>
            </div>
            <?= Html::a(
                    'More info ' . Html::tag('i', '', ['class' => 'fas fa-arrow-circle-right']),
                ['user/index'],
                ['class' => 'small-box-footer']
            ) ?>
        </div>
    </div>
</div>