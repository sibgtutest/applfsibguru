<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Template;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(['id' => 'post-'.$action, 'action' => ['post/'.$action, 'id' => $model->id, 'section' => $section], 'method' => 'post']); ?>

    <?= $form->field($model, 'name')->hiddenInput(['value' => $description])->label(false); ?>

    <?= $form->field($model, 'section')->hiddenInput(['value' => $section])->label(false); ?>

    <?= $form->field($model, 'key_post')->dropDownList(ArrayHelper::map(Template::find()->all(), 'name', 'name')) ?>

    <?= $form->field($model, 'value_post')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList(['0' => 'видимый', '1' => 'скрытый']) ?>

    <?= $form->field($model, 'rule')->hiddenInput(['value' => \Yii::$app->user->id])->label(false); ?>

    <?= $form->field($model, 'tag')->hiddenInput(['value' => '1'])->label(false); ?>

    <?= $form->field($model, 'updatedAt')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
