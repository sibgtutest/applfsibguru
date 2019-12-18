<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eiee\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'section')->textInput(['maxlength' => true])->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'key_profile')->textInput(['maxlength' => true])->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'value_profile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true])->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'rule')->textInput(['maxlength' => true])->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'tag')->textInput(['maxlength' => true])->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'createdAt')->textInput(['maxlength' => true])->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'updatedAt')->textInput(['maxlength' => true])->hiddenInput()->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
