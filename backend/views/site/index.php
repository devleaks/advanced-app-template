<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = Yii::$app->name . ' - '. Yii::t('app', 'Administration');
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome!</h1>

        <p class="lead">Welcome to <?= Yii::$app->name ?>.</p>

        <p><a class="btn btn-lg btn-success" href="<?= Url::to(['/']) ?>">Get started with <?= Yii::$app->name ?>!</a></p>
    </div>

    <div class="body-content">

        <div class="row">
	
            <div class="col-lg-2 col-lg-offset-3">
                <h3>Menu</h3>

				<ul style="list-style: none;padding-left:0;">
                </ul>

            </div>

        </div>

    </div>
</div>
