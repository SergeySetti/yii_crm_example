<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use League\ISO3166\ISO3166;

/* @var $this yii\web\View */
/* @var $model app\models\ClientModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', 'Blacklisted' => 'Blacklisted', ]) ?>

    <?= $form->field($model, 'country')
        ->dropDownList(
            ArrayHelper::map((new ISO3166())->all(), 'alpha2', 'name')
        ) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
