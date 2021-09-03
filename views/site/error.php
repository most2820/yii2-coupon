<?php

declare(strict_types=1);

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>
    <h1><?= $exception->statusCode ?></h1>
    <p class="subtitle">
        <?= $exception->getMessage() ?>
    </p>
<?= Html::a('Go back to main page', Url::home(), ['btn']) ?>