<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PostSearch */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="row">
        <div class="col-lg-5">
       <?php  $form = ActiveForm::begin(['id' => 'updatevariant']); ?>

            <?= $form->field($model, 'variant_id')->textInput(['type' => 'text']) ?>
            <?= $form->field($model, 'price')->textInput() ?>

            <?= $form->field($model, 'inventory') ?>

            <div class="form-group">
                <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'update']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
