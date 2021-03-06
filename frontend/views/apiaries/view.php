<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use voime\GoogleMaps\Map;

/* @var $this yii\web\View */
/* @var $model frontend\models\Apiaries */

$this->title = Yii::t('app_frontend','Apiary') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app_frontend','Apiaries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title; 
?>
<div class="apiaries-view">

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'start_date',
            [
                'attribute' => 'end_date',
                'visible' => (empty($model->end_date)? false : true)
            ],
            'name',
            'type0.labelT',
            'status0.labelT',
        ],
    ]) ?>


       <?php
           echo Map::widget([
            'zoom' => 9,
            'center' => [explode(",", $model->location, 2)[0],explode(",", $model->location, 2)[1]],
            'width' => '100%',
            'height' => '240px',
             'mapType' => Map::MAP_TYPE_HYBRID,
            'apiKey'=> 'AIzaSyCDNigM5ah2vT2IxRNUsyHh0m-3W3qtZYQ',
            'markers' => [
                [
                    'position' => [explode(",", $model->location, 2)[0],explode(",", $model->location, 2)[1]],
                    'title' => $model->name,
                    'content' => $model->name,
                ],

            ]
           ]);
        ?>

    <br>
    <div class="row">
        <div class="col-xs-12">
        <?= Html::a(ucfirst(Yii::t('app_frontend_bttn','update')), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(ucfirst(Yii::t('app_frontend_bttn','delete')), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(ucfirst(Yii::t('app_frontend_bttn','create new apiary')), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-6">
            <?= Html::a(ucfirst(Yii::t('app_frontend_female','previous')), ['view', 'id' => $model->previousId], ['class' => 'btn btn-default'.(empty($model->previousId)?' disabled':'')]); ?>
        </div>
        <div class="col-xs-6 text-right">
            <?= Html::a(ucfirst(Yii::t('app_frontend_female','next')), ['view', 'id' => $model->nextId], ['class' => 'btn btn-default'.(empty($model->nextId)?' disabled':'')]); ?>
        </div>
    </div>


</div>
<!-- http://getbootstrap.com/css -->
