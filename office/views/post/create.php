<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $description;
$this->params['breadcrumbs'][] = ['label' => $description, 'url' => ['post/index/', 'section' => $section]];
$action = 'create';

?>
<div class="post-create">

    <?= $this->render('_form', [
        'model' => $model,
        'section' => $section,
        'description' => $description,
        'action' => $action,
    ]) ?>

</div>