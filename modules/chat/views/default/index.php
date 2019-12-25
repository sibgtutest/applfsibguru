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
            <label><?php /* Html::encode($familyname[0]['value_profile']) .' '.
                        Html::encode($name[0]['value_profile']) .' '.
                        Html::encode($secondname[0]['value_profile']) */ ?>
                   <?= 'from: ' . Html::encode($value['userid']) 
                       . ' - to: ' . Html::encode($value['childid']) ?></label> (<?= Html::encode($value['updateDate']) ?>) 
            <p><?= Html::encode($value['message'])  ?></p>
        </li>
    <?php endforeach; ?>
</ul>     



<div class="container-fluid">
<nav class="navbar navbar-fixed-bottom">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'userid')->hiddenInput(['value' => $userid])->label(false); ?>  
        <div class="input-group">
            <span class="input-group-addon">
                <button type="button" 
                        class="glyphicon glyphicon-user" 
                        data-toggle="modal" 
                        data-target="#myModal"> 
                </button>            
                <!-- i class="glyphicon glyphicon-user"></i -->
            </span>
            <input name="Chat[message]" type="text" id="chat-message" class="form-control" placeholder="Search">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit" formaction="/chat/default/index">
                    <i class="glyphicon glyphicon-search"></i>
                </button>
            </div>
        </div> 
    <?php ActiveForm::end(); ?>
</nav>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">СКОРО БУДЕТ</h4>
      </div>
      <div class="modal-body">
        <p>В настоящее время мы работаем над новым сайтом. Оставайтесь с нами!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>