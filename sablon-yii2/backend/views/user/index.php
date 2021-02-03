<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\AuthAssignment;
use backend\models\AuthItem;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Utilizatori';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><i class='glyphicon glyphicon-user'></i> <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Adaugă utilizator', ['/site/signup'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Resetează parola', ['/site/reset-password'], ['class' => 'btn btn-danger']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
           
            'username',
            'nume',
            [
             'attribute' => 'id_ord',
             'content' => function ($model)
              {
                  return $model->ord->denumire;
              },
             'label' => 'Ordonator',
            ],
            'telefon',
            'email:email',
             [     
                'label' => 'Tip utilizator',                                           
                'attribute' => 'privilegiu',
                'filter' => array('1'=>'Administrator', '2'=>'Lucrător'),
                'value' => function($data) {
                    $values = array('1'=>'Administrator', '2'=>'Lucrător');

                    $auth_assign = AuthAssignment::find()->where(['user_id' => $data->id])->one();
                    $auth_item = AuthItem::find()->where(['name' => $auth_assign['item_name']])->one();

                    return $values[$auth_item['type']];
                }        
            ],
            [
               'label'=> 'Status',
                'attribute' => 'status',
                'filter'=>array("9" => "Inactiv", "10" => "Activ"),
                'value' => function ($row){
                    $values =[
                        '9' => 'Inactiv',
                        '10' => 'Activ',
                    ];
                    return $values[$row->status];
                } 
            ],              

            [
                'class' => 'yii\grid\ActionColumn', 
                'header' => 'Acțiuni',  
                'headerOptions' => ['style' => 'width:11%'],
                'template' => '{view} <br> {update} <br> {dez}',
                'visible' => Yii::$app->user->can('admin'),
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open text-success"></span> <span class="text-success">Vizualizează</span>', $url, [
                            'title' => Yii::t('app', 'Vizualizează'),
                        ]);
                    },                    
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil text-info"></span> <span class="text-info">Modifică</span>', $url, [
                            'title' => Yii::t('app', 'Modifică'),
                        ]);
                    },
                    'dez' => function ($url, $model) {
                        if ($model->status == 10)
                        {
                            $url = 'index.php?r=user/update2&id='.$model->id.'&act=1';
                                return Html::a('<span class="glyphicon glyphicon-remove text-danger"></span> <span class="text-danger">Dezactivează</danger>', $url, [
                                    'title' => Yii::t('app', 'Dezactivează user'),
                            ]);
                        } 
                        else if ($model->status == 9)
                        {
                            $url = 'index.php?r=user/update2&id='.$model->id.'&act=2';
                                return Html::a('<span class="glyphicon glyphicon-ok text-danger"></span> <span class="text-danger">Activează</danger>', $url, [
                                    'title' => Yii::t('app', 'Activează user'),
                            ]);
                        }
                    }
                ],
            ],


        ],
    ]); ?>


</div>

<style>
td{
    white-space: normal !important;
  }
</style>