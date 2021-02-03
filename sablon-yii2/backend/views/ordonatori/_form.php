<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ordonatori */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ordonatori-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'denumire')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Adaugă', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
