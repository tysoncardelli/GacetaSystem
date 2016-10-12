<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\daterange\DateRangePicker;

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

            'id',
            'asunto',
            'numero',
            [
                'attribute' => 'fecha_publicacion',
                'value' => 'fecha',
                'format'=>'raw',
                'options' => ['style' => 'width: 25%;'],
                'filter' => DateRangePicker::widget([
                'model' => $searchModel,
                'attribute' => 'fecha_publicacion',
                'useWithAddon'=>false,
                'convertFormat'=>true,
                'pluginOptions'=>[
                    'locale'=>['format'=>'Y-m-d']
                ],
                ])
            ],
            'ruta',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
