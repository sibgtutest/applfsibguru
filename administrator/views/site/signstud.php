<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'SignStud';

?>
<div class="site-signstud">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Please fill out the following fields to signup:</p>
    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'form-signstud']); ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signstud-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>