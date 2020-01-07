<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eiee\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $desc;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create', 'section' => $section], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'name',
            //'section',
            'key_profile',
            'value_profile',
            //'status',
            //'rule',
            //'tag',
            'createdAt',
            'updatedAt',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'template' => "<div style='width:90px; display:inline-block;'>" .
                            "{view} {save} {update} {delete}" .
                            "</div>",
                'buttons' => [
                    'view' => function ($url,$model) {
                        return Html::a('<span>Посмотреть</span>', $url);
                    },
                    'update' => function ($url,$model) {
                        if ($model->status == '1') {
                            return ' | ' . Html::a('<span>Изменить</span>', $url);
                        };
                    },
                    'delete' => function ($url,$model) {
                        if ($model->status == '1') {
                            return ' | ' . Html::a('<span>Удалить</span>', $url, [
                                    'data' => [
                                        'confirm' => 'Вы уверены, что хотите удалить этот документ?',
                                        'method' => 'post',
                                    ],
                                ]);
                        };
                    },
                    'save' => function ($url,$model,$key) {
                        if ($model->status == '1') {
                            return ' | ' . Html::a('Сохранить', $url, [
                                        'data' => [
                                            'confirm' => 'Вы уверены, что хотите сохранить этот документ? Сохранить | Изменить | Удалить - будут не доступны.',
                                        ],
                                    ]);
                        };
                    },
                ]
            ],
        ],
    ]); ?>


</div>
