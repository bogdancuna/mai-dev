<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\AuthAssignment;
use backend\models\AuthItem;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Ordonatori;

$this->title = 'Adaugă utilizator';
$this->params['breadcrumbs'][] = ['label' => 'Utilizatori', 'url' => ['user/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup" align="center">
    <h1><?= Html::encode($this->title) ?></h1>
    <br>
        <div style="width: 50%;">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

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

                <?= $form->field($model, 'email') ?>

                <label>Tip utilizator (privilegiu)</label>
                <?php 
            
                    echo $form->field($model, "privilegiu")->widget(Select2::classname(), [
                      'name'  => 'privilegiu',                                    
                      'data'  =>  ArrayHelper::map(AuthItem::find()->all(), 'name','description'),
                      'options' => ['multiple' => false, 'placeholder' => 'Selectează tipul utilizatorului'],
                      'pluginOptions' => [
                              'allowClear' => false,

                       ],
                ])->label(false);   
                
                ?>

                <?= $form->field($model, 'password')->passwordInput()->label('Parolă') ?>

                <div class="form-group" style="width: 50%;">
                    <?= Html::submitButton('<span class="glyphicon glyphicon-ok"></span> Salvează', ['class' => 'btn btn-primary btn-block']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
