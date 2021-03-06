<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php 
$_SESSION['log']=0;
 ?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    
    NavBar::begin([
        'brandLabel' => "<img src='". Yii::$app->request->baseUrl ."/gobernacion.png' style='margin-top: -20px; margin-left:-120px;' class='img-responsive'>",        
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse  navbar-fixed-top',            
        ],
    ]);
        $session = Yii::$app->session->get('rol');                   
        
        if($session === 0){                   
           echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [

                ['label' => 'Gacetas', 'url' => ['/gaceta/index']],
                
                ['label' => 'Usuarios', 'url' => ['/backend-user/index']],

                Yii::$app->user->isGuest ? (

                    ['label' => 'Login', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                    . Html::submitButton(
                        'Salir (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'mover btn btn-link navbar-inverse']
                    )
                    . Html::endForm()
                    . '</li>'
                )
                ],
            ]);
        }

        if($session === 1 || Yii::$app->session->get('rol') === null){
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [

                ['label' => 'Gacetas', 'url' => ['/gaceta/index']],                        

                Yii::$app->user->isGuest ? (

                    ['label' => 'Login', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                    . Html::submitButton(
                        'Salir (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'mover btn btn-link navbar-inverse',]
                    )
                    . Html::endForm()
                    . '</li>'
                )
                ],
            ]);
        }
        

    NavBar::end();
    ?>

    <div class="container">
    <?php echo "<br><br>"; ?>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer" style = "background-color: #7589A2">
    <div class="container">
        <center>
            <img src="<?= Yii::$app->request->baseUrl . "/logo_base.png" ?>" style="margin-top: -18px"></img>
        </center>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
