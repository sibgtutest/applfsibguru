<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = 'Update Post: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['post/index', 'section' => $section]];
$action = 'update';
?>
<div class="post-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'section' => $section,
        'description' => $description,
        'action' => $action,
    ]) ?>

</div>
