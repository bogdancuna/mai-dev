<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Loguri sistem';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index">

    <h1><i class="fas fa-cogs"></i> <?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id_user_log',
                'content' => function($model){
                    if($model->id_user_log)
                    {
                        $aux = User::find()->where(['id' => $model->id_user_log])->one();
                        return "<b>".$aux['username']."</b>";
                    }
                }
            ],
            'action_log',
            'tabela_log',

            [
                'attribute' => 'id_model_log',
                'label' => 'Entitate modificată',
                'content' => function($model){
                    if($model->tabela_log == 'UTILIZATOR')
                    {
                        $aux = User::find()->select('id, username')->where(['id' => $model->id_model_log])->one();
                        return '['.$model->id_model_log.'] => ' .$aux['username'];
                    }
                    else {
                        {
                            return $model->id_model_log;
                        }
                    }
                }
            ],

            [
                'attribute' => 'changes_log',
                'format' => 'raw',
            ],
            
            'data_log',
            'ip_log',
        ],
    ]); ?>


</div>

<style>

td{
        white-space: normal !important;
    }
    
</style>