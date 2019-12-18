<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eiee\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контактные данные';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-form">
    <div class="row">
        <div class="col-sm-6">
            <?php $form = ActiveForm::begin(); ?>
                <?php foreach ($models as $model): ?>
                    <div class="form-group кщц">
                        <div class="input-group">
                            <span class="input-group-addon"><?= $model['key_profile'] ?></span>
                            <p><?= "<input 
                                    for='ex2'
                                    class='form-control' 
                                    type='text' 
                                    name='value_profile' 
                                    value='" . $model['value_profile'] . "' />" ?></p>
                        </div>
                    </div>                            
                <?php endforeach; ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
</div>
