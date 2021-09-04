<?php

declare(strict_types=1);

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="error-page">
    <h2 class="headline text-warning">
        <?= $exception->statusCode ?>
    </h2>
    <div class="error-content">
        <h3>
            <i class="fas fa-exclamation-triangle text-warning"></i>
            <?= $exception->getMessage() ?>
        </h3>
        <p>
            Meanwhile, you may <?= Html::a('return to dashboard', Url::home(), ['btn']) ?>.
        </p>
    </div>
</div>