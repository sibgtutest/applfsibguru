<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $description;
?>
<div class="post-index">

    <p>
        <?= Html::a('Добавить запись', ['create', 'section' => $section], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'tag',
            //'id',
            //'name',
            //'section',
            'key_post',
            'value_post:ntext',
            //'status',
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    if ($data['status'] == '1') {
                        return Html::checkbox('status', 0, ['disabled' => true]);
                    } else {
                        return Html::checkbox('status', 1, ['disabled' => true]);
                    }
                }, 'format' => 'raw'
            ],
            //'rule',

            'updatedAt',

            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => "<div style='width:70px; display:inline-block;'>" .
                    "{update} {delete}" .
                    "</div>",
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span>Обновить</span>', $url);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span>Удалить</span>', $url, [
                            'data' => [
                                'confirm' => 'Вы уверены, что хотите удалить эту запись?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ]
            ],
        ],
    ]); ?>

    <p>
        <?= Html::a('Добавить запись', ['create', 'section' => $section], ['class' => 'btn btn-success']) ?>
    </p>
</div>