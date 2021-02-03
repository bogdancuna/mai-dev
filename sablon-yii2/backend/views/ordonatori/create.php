<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ordonatori */

$this->title = 'Adaugă Ordonator';
$this->params['breadcrumbs'][] = ['label' => 'Ordonatori', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ordonatori-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
