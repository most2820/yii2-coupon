<?php

declare(strict_types=1);

/* @var $this yii\web\View */
/* @var $coupon Coupon */

/* @var $model CouponForm */

use app\models\coupon\Coupon;
use app\models\coupon\CouponForm;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\web\JsExpression;

$this->title = $coupon ? 'Update' : 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Coupons', 'url' => ['index']];
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
        <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
        <?= $form->field($model, 'shopId')->widget(Select2::classname(), [
            'name' => 'shopId',
            'data' => $shops,
            'options' => [
                'placeholder' => 'Select shop...',
            ],
            'pluginOptions' => [
                'allowClear' => false,
                'minimumInputLength' => 1,
                'language' => [
                    'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                ],
                'ajax' => [
                    'delay' => 250,
                    'url' => \yii\helpers\Url::toRoute(['shop-autocomplete']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(shop) { return shop.name; }'),
                'templateSelection' => new JsExpression('function (shop) { return shop.text; }'),
            ],
        ]); ?>
        <?= $form->field($model, 'type')->dropDownList(Coupon::getTypes()) ?>
        <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'startAt')->input('datetime-local') ?>
        <?= $form->field($model, 'endAt')->input('datetime-local') ?>
        <?= $form->field($model, 'status')->dropDownList(Coupon::getStatuses()) ?>
    </div>
    <div class="card-footer">
        <div class="btn-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <?php if ($coupon) : ?>
                <?= Html::a('Remove', ['delete', 'id' => $coupon->id], [
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
