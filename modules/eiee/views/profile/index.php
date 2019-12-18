<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\eiee\models\Profile;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контактные данные';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
    $userid = \Yii::$app->user->identity->id;
    $query = Profile::find()->where(['section' => 'Profile'])
        ->andWhere(['rule' => $userid])
        ->andWhere(['key_profile' => 'Портрет'])->asArray()->One();  
?>
<div class="profile-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-sm-7">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'tableOptions' => ['class' => 'table table-hover table-striped'],
                'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    //'name',
                    //'section',
                    'key_profile',
                    'value_profile',
                    //'status',
                    //'rule',
                    //'tag',
                    //'createdAt',
                    //'updatedAt',

                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{update}',
                        'buttons' => [
                            'update' => function ($url, $model) {
                                $userid = \Yii::$app->user->identity->id;
                                $query = Profile::find()->where(['section' => 'Profile'])
                                    ->andWhere(['rule' => $userid])
                                    ->andWhere(['key_profile' => 'Портрет'])->asArray()->One();  
                                if ($query['status'] == '0') {
                                    return Html::a('Обновить', '', [
                                        'class'=>'btn btn-primary btn-xs',                                  
                                    ]);
                                }
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
        <div class="col-sm-5">
            <img src="<?= $query['value_profile'] ?>" class="img-thumbnail" alt="Cinque Terre">
        </div>
    </div>
</div>