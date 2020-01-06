<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eiee\models\Profile */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'Учебная работа студента', 'url' => ['index', 'section' => 'academic']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
