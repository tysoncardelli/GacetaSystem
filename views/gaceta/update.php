<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Gaceta */

$this->title = 'Actualizar Gaceta: ';
$this->params['breadcrumbs'][] = ['label' => 'Gacetas', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="gaceta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
