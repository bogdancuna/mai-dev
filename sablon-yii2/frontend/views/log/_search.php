<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\LogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_log') ?>

    <?= $form->field($model, 'id_user_log') ?>

    <?= $form->field($model, 'action_log') ?>

    <?= $form->field($model, 'tabela_log') ?>

    <?= $form->field($model, 'id_model_log') ?>

    <?php // echo $form->field($model, 'changes_log') ?>

    <?php // echo $form->field($model, 'data_log') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
