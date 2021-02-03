<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ordonatori */

$this->title = 'Modifică Ordonator: ' . $model->denumire;
$this->params['breadcrumbs'][] = ['label' => 'Ordonatori', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->denumire, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modifică';
?>
<div class="ordonatori-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
