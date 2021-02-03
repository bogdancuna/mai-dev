<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\AuthAssignment;
use backend\models\AuthItem;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Ordonatori;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form" align="center">

    <br>
    <div style="width: 50%;">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'nume')->textInput() ?>

        <?=  $form->field($model, 'id_ord')->widget(Select2::classname(), [
                                        'data' => ArrayHelper::map(Ordonatori::find()->all(), 'id','denumire'),
                                        'options' => ['placeholder' => 'Selectează ordonatorul'],
                                        'pluginOptions' => [
                                            'allowClear' => false
                                        ],
                                    ])->label('Ordonator');
        ?>

        <?= $form->field($model, 'telefon')->textInput() ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    
            <?php
                $array = array('1'=>'Administrator', '2'=>'Lucrător');
            ?>
            <label>Tip utilizator (privilegiu)</label>
            <?php

                $privilegii = [];
                $auth_assign = AuthAssignment::find()->where(['user_id' => $model->id])->all();
                foreach ($auth_assign as $key) {
                    $auth_item = AuthItem::find()->where(['name' => $key['item_name']])->one();
                    $privilegii[] = $auth_item['name'];                  
                }
                        
                echo Select2::widget([
                                    'name' => 'privilegiu',
                                    'value' => $privilegii,
                                    'data' =>  ArrayHelper::map(AuthItem::find()->all(), 'name','description'),
                                    'options' => ['multiple' => false, 'placeholder' => 'Selectează tipul utilizatorului', 'required' => true],
                                    'pluginOptions' => [
                                        'allowClear' => false
                                    ],
                            ]);
            ?>
            <br>
            <div class="form-group" style="width: 50%;">
                 <?= Html::submitButton($model->isNewRecord ? '<span class="glyphicon glyphicon-ok"></span> Salvează' : '<span class="glyphicon glyphicon-ok"></span> Modifică', ['class' => $model->isNewRecord ? ' btn btn-primary btn-block' : 'btn btn-primary btn-block']) ?>
            </div>
        </div>    

    <?php ActiveForm::end(); ?>

</div>
