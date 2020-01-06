<?php

use yii\helpers\Html;

if (Yii::$app->user->can('stud')) {

?>

    <?= $this->render('_stud'); ?>

<?php 

} if (Yii::$app->user->can('staf')) {

?>

    <?= $this->render('_staf'); ?>

<?php 

}

?>