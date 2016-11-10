<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BackendUser */

$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];

?>
<div class="backend-user-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php 
        $session = Yii::$app->session->get('rol');                   
        
        if($session == 1){                   
           Yii::$app->response->redirect(["/gaceta/index"]);
        }

        if(Yii::$app->session->get('rol') === null){
            Yii::$app->response->redirect(["/gaceta/index"]);
        }
    ?>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Desea eliminar el usuario?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [            
            'nombre',
            'apellido',
            'username',            
            'fecha_caducidad',            
        ],
    ]) ?>

</div>
