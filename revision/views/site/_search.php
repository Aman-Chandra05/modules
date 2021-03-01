<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PostSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-search">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'from')?>

    <?= $form->field($model, 'to') ?>

    <?php ActiveForm::end(); ?>
</div>
