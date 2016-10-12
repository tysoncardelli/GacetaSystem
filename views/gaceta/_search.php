<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GacetaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gaceta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'asunto') ?>

    <?= $form->field($model, 'numero') ?>

    <?php 
        echo '<label>Fecha de Publicación</label><br>'; 
        echo DatePicker::widget([ 
            'model' => $model,
            'attribute' => 'fecha_publicacion',
            'language' => 'es',
            'dateFormat' => 'yyyy-MM-dd',
        ]);

        echo "<label></label><br><br>";
    ?>
    
    <?= $form->field($model, 'ruta') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
