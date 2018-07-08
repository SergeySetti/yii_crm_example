<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use League\ISO3166\ISO3166;
use app\models\UserModel;

/* @var $this yii\web\View */
/* @var $model app\models\UserModel */
/* @var $form ActiveForm */
?>
<div class="signup">
    <h1>SignUp</h1>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'signup-form',]); ?>

            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'real_name') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'password_repeat')->passwordInput() ?>
            <?= $form->field($model, 'subscription_type')
                ->dropDownList(\app\models\UserModel::SUBSCRIPTION_TYPES) ?>
            <?= $form->field($model, 'company_name') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'country')
                ->dropDownList(
                ArrayHelper::map((new ISO3166())->all(), 'alpha2', 'name')
            ) ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>

            <script>
                window.addEventListener('load', function(){
                    jQuery(document).ready(function(){
                        const dropList = jQuery('#signupform-subscription_type');
                        dropList.change(function(){
                            if (dropList.val() === "<?=UserModel::SUBSCRIPTION_TYPE_COMPANY?>") {
                                jQuery('.field-signupform-company_name').show();
                            }
                            else {
                                jQuery('.field-signupform-company_name').hide();
                            }
                        })
                    });
                }, false );

            </script>
        </div>
    </div>
</div><!-- signup -->
