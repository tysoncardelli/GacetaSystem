<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BackendUserSerch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="backend-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
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
        <?= Html::a('Registrar Usuarios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'apellido',
            'username',            
            // 'fecha_caducidad',
            // 'Rol',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
