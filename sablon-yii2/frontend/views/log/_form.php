<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Log */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_user_log')->textInput() ?>

    <?= $form->field($model, 'action_log')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tabela_log')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_model_log')->textInput() ?>

    <?= $form->field($model, 'changes_log')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_log')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
