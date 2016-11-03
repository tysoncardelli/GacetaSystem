<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Gaceta */

$this->title = "Ver Gaceta";
$this->params['breadcrumbs'][] = ['label' => 'Gacetas', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gaceta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php 
    if(Yii::$app->session->get('rol') !== null){
    ?>
    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Desea eliminar la gaceta?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php 
        }
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            'asunto',
            'numero',
            'fecha_publicacion',
            [
                'attribute'=>'Archivo',
                'format'=>'raw',
                'value'=>Html::a('Ver Archivo', '/'.$model->ruta, ['class' => 'btn btn-success', 'target'=>'_blank']),
            ]
        ],
    ]) ?>

</div>
