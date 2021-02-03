<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OrdonatoriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ordonatori';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ordonatori-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Adaugă Ordonator', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'denumire',
            //'tip_ord',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
