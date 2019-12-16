<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eiee\models\Profile */

$this->title = 'Обновить: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Учебная работа студента', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Посмотреть', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form1', [
        'model' => $model,
    ]) ?>

</div>
