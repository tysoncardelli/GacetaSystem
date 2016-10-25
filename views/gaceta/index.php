<?php

use yii\helpers\Html;
use yii\grid\GridView;
use jino5577\daterangepicker\DateRangePicker; 

/* @var $this yii\web\View */
/* @var $searchModel app\models\GacetaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gacetas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gaceta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Gaceta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],                        
            'numero',
            'asunto',
            [
                // the attribute
                'attribute' => 'fecha_publicacion',                
                // here we render the widget
                'filter' => DateRangePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at_range',
                    'pluginOptions' => [
                    'format' => 'Y-m-d',
                    'autoUpdateInput' => false
                ]
                ])
            ],            
            [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{view} {update} {delete} {download}',
            'buttons'=>[
                'download'=>function($url,$model,$key){
                    return $model->ruta !='' ? Html::a(
                    '<span class="glyphicon glyphicon-file"</span>',
                     $model->ruta): $model->ruta;
                },
            ],
            ],
        ],
    ]); ?>
</div>
