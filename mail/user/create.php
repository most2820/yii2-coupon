<?php

declare(strict_types=1);

use app\models\user\User;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user User */
/** @var string $password */

$loginLink = Yii::$app->urlManager->createAbsoluteUrl(['user/login']);
?>

<table cellpadding="0" cellspacing="0" style="padding:20px;width:100%">
    <tbody>
    <tr>
        <td style="font-family:'-apple-system' , 'blinkmacsystemfont' , 'segoe ui' , 'roboto' , 'oxygen' , 'ubuntu' , 'cantarell' , 'fira sans' , 'droid sans' , 'helvetica neue' , sans-serif">
            <table cellpadding="0" cellspacing="0"
                   style="line-height:1.4;padding:10px 10px 10px 0;text-align:left;width:100%">
                <tbody>
                <tr>
                    <td style="color:#333;font-size:24px">
                        <b>An account has been created for you</b>
                    </td>
                </tr>
                </tbody>
            </table>
            <table cellpadding="0" cellspacing="0"
                   style="color:#333;font-size:14px;line-height:1.4;text-align:left;width:100%">
                <tbody>
                <tr>
                    <td>
                        <div>
                            <p>
                                Hi, <?= $user->username ?>.
                                An account has been created for you in
                                <?= Html::a(Yii::$app->name, $loginLink, ['target' => '_blank']) ?>
                            </p>
                            <h4>Your account details:</h4>
                            <ul>
                                <li>Email:
                                    <?= Html::a($user->email, "mailto:{$user->email}", ['target', '_blank']) ?>
                                </li>
                                <li>Password: <?= $password ?></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
