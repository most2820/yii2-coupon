<?php

declare(strict_types=1);

use app\models\user\User;
use app\models\user\UserFilter;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $this yii\web\View */
/* @var $searchModel UserFilter */

$this->title = 'Users';
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
                    'attribute' => 'username',
                    'value' => function (User $model) {
                        return Html::a(Html::encode($model->username), ['update', 'id' => $model->id]);
                    },
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'email',
                    'value' => function (User $model) {
                        return $model->email;
                    },
                ],
                [
                    'attribute' => 'status',
                    'filter' => User::getStatuses(),
                    'value' => function (User $model) {
                        return $model->statusLabel;
                    }
                ],
            ],
        ]); ?>
    </div>
</div>