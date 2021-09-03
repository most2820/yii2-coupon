<?php

declare(strict_types=1);

/* @var $this yii\web\View */
/* @var $model EditForm */

/* @var $user User */

use app\models\user\User;
use app\models\user\EditForm;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Update';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
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
        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'status')->dropDownList(User::getStatuses()); ?>
    </div>
    <div class="card-footer">
        <div class="btn-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Remove', ['delete', 'id' => $user->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
