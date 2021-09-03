<?php

declare(strict_types=1);

/* @var $this yii\web\View */
/* @var $model CategoryFilter */

/* @var $category Category */

use app\models\category\Category;
use app\models\category\CategoryFilter;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = $category ? 'Update' : 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <?php $form = ActiveForm::begin([
        'options' => [
            'class' => 'form-horizontal'
        ],
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-2 col-form-label',
                'wrapper' => 'col-sm-10',
                'error' => '',
                'hint' => '',
            ],
        ],
    ]); ?>
    <div class="card-body">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'status')->dropDownList(Category::getStatuses()) ?>
    </div>
    <div class="card-footer">
        <div class="btn-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <?php if ($category) : ?>
                <?= Html::a('Remove', ['delete', 'id' => $category->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'method' => 'post',
                    ],
                ]) ?>
            <?php endif; ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
