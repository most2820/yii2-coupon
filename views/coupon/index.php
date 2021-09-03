<?php


use app\models\coupon\Coupon;
use app\models\coupon\CouponFilter;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $this yii\web\View */
/* @var $searchModel CouponFilter */

$this->title = 'Coupons';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-header">
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="card-body p-0">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'options' => [
                'class' => 'table-responsive',
            ],
            'tableOptions' => [
                'class' => 'table'
            ],
            'summaryOptions' => [
                'class' => 'text-center mb-3'
            ],
            'pager' => [
                'options' => [
                    'class' => 'pagination justify-content-center'
                ],
                'linkContainerOptions' => [
                    'class' => 'page-item'
                ],
                'linkOptions' => [
                    'class' => 'page-link'
                ],
                'prevPageCssClass' => 'd-none',
                'nextPageCssClass' => 'd-none',
            ],
            'columns' => [
                [
                    'attribute' => 'name',
                    'value' => function (Coupon $model) {
                        return Html::a(Html::encode($model->name), ['update', 'id' => $model->id]);
                    },
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'type',
                    'filter' => Coupon::getTypes(),
                    'value' => function (Coupon $model) {
                        return $model->typeLabel;
                    },
                    'format' => 'html',
                ],
                [
                    'attribute' => 'status',
                    'filter' => Coupon::getStatuses(),
                    'value' => function (Coupon $model) {
                        return $model->statusLabel;
                    }
                ],
            ],
        ]); ?>
    </div>
</div>