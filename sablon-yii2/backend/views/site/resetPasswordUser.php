<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$this->title = 'Schimbă parola';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <h1> <i class='glyphicon glyphicon-lock'></i> <?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

            <?php
                   $fieldOptions1 = [
                        'options' => ['class' => 'form-group'],
                        'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon" onclick="toggle_password1()"><a href="#"><i class="glyphicon glyphicon-eye-open toggle-password-1"></i></a></span></div>'
                    ]; 

                    $fieldOptions2 = [
                        'options' => ['class' => 'form-group'],
                        'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon" onclick="toggle_password2()"><a href="#"><i class="glyphicon glyphicon-eye-open toggle-password-2"></i></a></span></div>'
                    ];

                    $fieldOptions3 = [
                        'options' => ['class' => 'form-group'],
                        'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon" onclick="toggle_password3()"><a href="#"><i class="glyphicon glyphicon-eye-open toggle-password-3"></i></a></span></div>'
                    ];
            ?>

                <?= $form->field($model, 'old_password', $fieldOptions1)->passwordInput(['id' => 'pass1_id'])->label('Vechea parolă');  ?>
                <?= $form->field($model, 'password_hash', $fieldOptions2)->passwordInput(['id' => 'pass2_id'])->label('Noua parolă');  ?>
                <?= $form->field($model, 'password_hash1', $fieldOptions3)->passwordInput(['id' => 'pass3_id'])->label('Repetați noua parolă');  ?>


                <div class="form-group">
                    <?= Html::submitButton('Modifică', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
            <?php 
                if($hashError==1)
                    Yii::$app->session->setFlash('error', 'Vechea parolă introdusă nu este corectă!');
                else if($hashError==2)
                    Yii::$app->session->setFlash('error', 'Noua parolă nu coincide!');
                else if($hashError==3)
                    Yii::$app->session->setFlash('success', 'Parola a fost modificată cu succes!');
            ?>
        </div>
    </div>
</div>


<script type="text/javascript">

    function toggle_password1() {

        $('.toggle-password-1').toggleClass("glyphicon-eye-close");
        
        var input = $("#pass1_id");
        input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password');
    }

    function toggle_password2() {

        $('.toggle-password-2').toggleClass("glyphicon-eye-close");
        
        var input = $("#pass2_id");
        input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password');
    }

    function toggle_password3() {

        $('.toggle-password-3').toggleClass("glyphicon-eye-close");
        
        var input = $("#pass3_id");
        input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password');
    }

</script>