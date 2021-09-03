<?php

use app\models\category\Category;
use app\models\category\CategoryFilter;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $this yii\web\View */
/* @var $searchModel CategoryFilter */

$this->title = 'Categories';
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
                    'value' => function (Category $model) {
                        return Html::a(Html::encode($model->name), ['update', 'id' => $model->id]);
                    },
                    'format' => 'html',
                ],
                [
                    'attribute' => 'status',
                    'filter' => Category::getStatuses(),
                    'value' => function (Category $model) {
                        return $model->statusLabel;
                    }
                ],
            ],
        ]); ?>
    </div>
</div>