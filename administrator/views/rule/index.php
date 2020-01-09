<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Staf;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RuleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rules';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rule-index">

    <h1><?= Html::encode($this->title) ?> - <?= Html::a('Обновить', ['init']) ?></h1>

    <p>
        <?= Html::a('Create Rule', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'role'
            [
                'attribute'=>'role',
                'filter' => ArrayHelper::map(Staf::find()->asArray()->all(), 'username', 'username'),
            ],
            'permissions',
            'description:ntext',

            ['class' => 'yii\grid\ActionColumn',
                'template' => "<div>" .
                "{update} {delete}" .
                "</div>",
            ],
        ],
    ]); ?>


</div>
