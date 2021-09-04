<?php

declare(strict_types=1);

use app\models\user\LoginForm;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model LoginForm */

$this->title = 'Sign In';
?>
<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('email')])->label(false) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>
        <?= Alert::widget() ?>
        <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary btn-block']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>