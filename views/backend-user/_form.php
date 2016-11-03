<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\BackendUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="backend-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'fecha_caducidad')->textInput() ?>
    <?php 
        echo '<label>Fecha de Caducidad</label><br>'; 
        echo DatePicker::widget([ 
            'model' => $model,
            'attribute' => 'fecha_caducidad',
            'language' => 'es',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control']
        ]);
        
        echo "<label></label><br>";

        
    ?>

    <?= $form->field($model, 'Rol')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Registrar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
