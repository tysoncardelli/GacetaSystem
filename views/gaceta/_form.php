<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Gaceta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gaceta-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'asunto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero')->textInput(['maxlength' => true]) ?>

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


    <?= $form->field($model,'file')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
