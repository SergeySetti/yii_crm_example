<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ClientModel */

$this->title = 'Add Client';
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= /** @var array $payment_methods */
    $this->render('_form', [
        'model' => $model,
        'payment_methods' => $payment_methods,
    ]) ?>

</div>
