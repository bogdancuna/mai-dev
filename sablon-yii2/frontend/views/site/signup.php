<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\AuthAssignment;
use app\models\AuthItem;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Ordonatori;

$this->title = 'Adaugă utilizator';
$this->params['breadcrumbs'][] = ['label' => 'Utilizatori', 'url' => ['user/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
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

                <?= $form->field($model, 'password')->passwordInput()->label('Parola') ?>

                <div class="form-group">
                    <?= Html::submitButton('Salvează', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
