<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Gaceta */

$this->title = 'Registrar Gaceta';
$this->params['breadcrumbs'][] = ['label' => 'Gacetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gaceta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
