<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eiee\models\Profile */

$this->title = 'Изменить:';
$this->params['breadcrumbs'][] = ['label' => $desc, 'url' => [$section . '/index', 'section' => $section]];
$action = 'update';
?>
<div class="profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form1', [
        'model' => $model,
        'action' => $action,
    ]) ?>

</div>
