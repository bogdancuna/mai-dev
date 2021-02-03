<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\User;

$this->title = 'Resetează parola';
$this->params['breadcrumbs'][] = ['label' => 'Utilizatori', 'url' => ['user/index']];
$this->params['breadcrumbs'][] = $this->title;

$password_hash='';
?>
<div class="site-reset-password">
    <h1> <i class='glyphicon glyphicon-lock'></i> <?= Html::encode($this->title) ?></h1>

    <p>Alegeți o nouă parola:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

            <?php   
                $users = ArrayHelper::map(User::find()->all(),'id','username');                  
            ?>    

            <?= $form->field($model, 'username')->widget(Select2::classname(), [
                                    'data' => $users,
                                    'language' => 'en',
                                    'options' => [
                                        'placeholder' => 'Selectează un utilizator ...',                            
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ],
                                ])->label('Username');                                                                
            ?>

            <?php
                $fieldOptions = [
                    'options' => ['class' => 'form-group'],
                    'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon" onclick="toggle_password()"><a href="#"><i class="glyphicon glyphicon-eye-open toggle-password"></i></a></span></div>'
                ]; 
            ?>

            <?= $form->field($model, 'password_hash', $fieldOptions)->passwordInput(['id' => 'pass_id'])->label('Noua Parolă');  ?>

            <div class="form-group">
                <?= Html::submitButton('Salvare', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


<script type="text/javascript">

    function toggle_password() {

        $('.toggle-password').toggleClass("glyphicon-eye-close");
        
        var input = $("#pass_id");
        input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password');
    }

</script>