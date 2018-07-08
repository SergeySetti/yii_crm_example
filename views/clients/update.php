<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ClientModel */

$this->title = 'Update Client Model: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Client Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="client-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= /** @var array $payment_methods */
    $this->render('_form', [
        'model' => $model,
        'payment_methods' => $payment_methods,
    ]) ?>

</div>
