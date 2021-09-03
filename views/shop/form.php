<?php

declare(strict_types=1);

/* @var $this View */
/* @var $model ShopFilter */

/* @var $shop Shop */

use app\components\View;
use app\models\shop\Shop;
use app\models\shop\ShopFilter;
use app\widgets\ImageInput;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = $shop ? 'Update' : 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Shops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <?php $form = ActiveForm::begin([
        'options' => [
            'class' => 'form-horizontal',
            'enctype' => 'multipart/form-data'
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
        <?= $form->field($model, 'image')->widget(ImageInput::class, [
            'value' => $this->imageManager->generateUrl($model->image),
            'options' => [
                'class' => 'form-control mb-3',
                'style' => 'width: 126px;height: auto;'
            ]
        ])
        ?>
        <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
        <?= $form->field($model, 'categories')->checkboxList($categories ?: [], [
            'class' => 'form-control',
            'style' => 'height: auto'
        ])
        ?>
        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'status')->dropDownList(Shop::getStatuses()) ?>
    </div>
    <div class="card-footer">
        <div class="btn-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <?php if ($shop) : ?>
                <?= Html::a('Remove', ['delete', 'id' => $shop->id], ['class' => 'btn btn-danger',
                    'data' => [
                        'method' => 'post',
                    ],
                ]) ?>
            <?php endif; ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
