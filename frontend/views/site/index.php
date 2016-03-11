<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = Yii::$app->name;
?>
<div class="site-index">


    <div class="jumbotron">

        <h1>Welcome!</h1>

        <p class="lead">Welcome to Your Application Account.</p>

        <p><a class="btn btn-lg btn-success" href="<?= Url::to(['/user/login']) ?>">Get started with Your Application</a></p>

		<img src="/images/welcome.png" class="center" />

    </div>

    <div class="body-content">
	
        <div class="row">
            <div class="col-lg-6">
                <h2>Menus for Visitors</h2>

                <ul>
                    <li><a href="<?= Url::to(['/']) ?>">APP</a></li>
                </ul>

            </div>

        </div>

    </div>

</div>
