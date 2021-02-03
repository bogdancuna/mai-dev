<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap bimg">
    <?php
    NavBar::begin([
        'brandLabel' => '<span class="glyphicon glyphicon-home" style="color:#c0c0c0"></span> ACASĂ',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '<span class="glyphicon glyphicon-off" style="color:#009700"></span> Logare', 'url' => ['/site/login']];
    } else {

        /*     ADMINISTRARE    */
        if(Yii::$app->user->can('admin'))
        {
            $menuItems[] = [             
                    'label' => Html::tag('i','',['class' => 'fas fa-tools', 'style'=>'color:#009700']) .' Administrare',
                    'items' => [ 
                        ['label' => Html::tag('i','',['class' => 'fas fa-user-cog']) .' <b>Utilizatori</b>', 'url' => ['/user/index']],  
                            '<li class="divider"></li>',
                        ['label' => Html::tag('span','',['class' => 'fas fa-stream']) .' Ordonatori', 'url' => ['/ordonatori/index']],                     
                        '<li class="divider"></li>',                
                        ['label' => Html::tag('span','',['class' => ' fas fa-cogs']) .' Loguri sistem', 'url' => ['/log/index']],                    
                    ]       
                ];
       }
       
       /*     SCHIMBA PAROLA    */
       $menuItems[] =  ['label' => Html::tag('i','',['class' => ' fas fa-unlock-alt', 'style'=>'color:#009700']) .' Schimbă parola', 'url' => ['/site/reset-password-user']];
       
       /*     LOGOUT    */
       $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                '<i class="fas fa-sign-out-alt" style="color:#009700"></i>'. ' Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        'encodeLabels' => false,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-right">&copy; DACTI <?= date('Y') ?></p>
        <p class="pull-left"> <img src="Sigla.png" style="display:inline; vertical-align: top; height:32px;"> Ministerul Afacerilor Interne</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


<style>

.bimg {
    background-color: transparent !important;
    background-image: url("sigla1.png") !important; 
    background-repeat: no-repeat;
    background-size: 250px 330px;
    background-attachment: fixed;
    background-position: 100% 90%;
}

.navbar-fixed-top
{
    background-image: url("logo_mai.png") !important; 
    background-repeat: no-repeat;
    background-size: 130px 50px;
    background-attachment: fixed;
    background-position: 100% 0%;
}
.navbar-toggle
{
  background-color:  rgb(51, 51, 51);
}
</style>