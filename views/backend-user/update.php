<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BackendUser */

$this->title = 'Actualizar Usuario';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="backend-user-update">

	<?php 
        $session = Yii::$app->session->get('rol');                   
        
        if($session == 1){                   
           Yii::$app->response->redirect(["/gaceta/index"]);
        }

        if(Yii::$app->session->get('rol') === null){
            Yii::$app->response->redirect(["/gaceta/index"]);
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
