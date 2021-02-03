<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>

<br>
<img class="center" src="logo.png" alt="" class="center" width="20%">
<div class="site-login">

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4" align="center">

            <h1><?= Html::encode($this->title) ?></h1>
            <br><br>

            <?php
               $fieldOptions = [
                    'options' => ['class' => 'form-group'],
                    'inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>{input}<span class="input-group-addon" onclick="toggle_password()"><a href="#"><i class="glyphicon glyphicon-eye-open toggle-password"></i></a></span></div>'
                ]; 
            ?>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>           

                <?= $form->field($model, 'username', [
                    'template' => '{beginLabel}{labelTitle}{endLabel}<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>{input}
                    </div>{error}{hint}'
                    ])->textInput()->label('<b><font size="4"> Utilizator</font></b>') ?>

                <?= $form->field($model, 'password', $fieldOptions)->passwordInput(['id' => 'pass_log_id'])->label('<b><font size="4"> Parolă</font></b>') ?>


                <?= $form->field($model, 'rememberMe')->checkbox()->label('Ține-mă minte') ?>
                
                <div class="form-group">
                  <button class="button1" style="background-color:forestgreen; display: block; margin: 0 auto;"><span>Login </span></button>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<script type="text/javascript">

    function toggle_password() {

        $('.toggle-password').toggleClass("glyphicon-eye-close");
        
        var input = $("#pass_log_id");
        input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password');
    }

    function activ()
    {
        var username = $("#loginform-username").val();
        $.ajax({
            url:'?r=site/activ',
            type:'POST',
            data:{username:username},
            success: function(res) {
                if(res > 0)
                {
                  alert('User inactiv!');
                  $('#loginform-username').val('');
                  $('#loginform-password').val('');
                }
            }
        });
    }

</script>

<style type="text/css">

.center {
    display: block;
    margin-left: auto;
    margin-right: auto;
 
}
.button1 {
  display: inline-block;
  border-radius: 10px;
  background-color: forestgreen;
  border: none;
  color: #FFFFFF;
  font-size: 17px;
  padding: 9px;
  width: 110px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 13px;
}

.button1 span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button1 span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button1:hover span {
  padding-right: 20px;
}

.button1:hover span:after {
  opacity: 1;
  right: 0;
}  
</style>