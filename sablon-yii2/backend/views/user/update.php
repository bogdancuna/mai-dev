<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Modifică Utilizator: ' . $model->nume;
$this->params['breadcrumbs'][] = ['label' => 'Utilizatori', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nume, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modifică';
?>
<div class="user-update" align="center">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
