<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $description;
$this->params['breadcrumbs'][] = ['label' => $description, 'url' => ['post/index', 'section' => $section]];

\yii\web\YiiAsset::register($this);
?>
<div class="post-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'section',
            'key_post',
            'value_post:ntext',
            'status',
            'rule',
            'tag',
            'updatedAt',
        ],
    ]) ?>

</div>