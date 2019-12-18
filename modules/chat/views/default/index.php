<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$userid = \Yii::$app->user->identity->id;

$this->title = 'Взаимодействие между участниками образовательного процесса';
$this->params['breadcrumbs'][] = $this->title;
?>


<ul class="list-group">
    <?php foreach ($query as $value) : ?>
        <li class="list-group-item">
            <label><?= Html::encode($value['userid'])  ?></label>: <?= Html::encode($value['updateDate']) ?> 
            <p><?= Html::encode($value['message'])  ?></p>
        </li>
    <?php endforeach; ?>
</ul>     



<div class="container-fluid">
<nav class="navbar navbar-fixed-bottom">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'userid')->hiddenInput(['value' => $userid])->label(false); ?>  
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input name="Chat[message]" type="text" id="chat-message" class="form-control" placeholder="Search">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit">
                    <i class="glyphicon glyphicon-search">ОтправитьОтправитьОтправить</i>
                </button>
            </div>
        </div> 
    <?php ActiveForm::end(); ?>
</nav>
</div>
