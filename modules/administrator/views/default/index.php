<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $model \app\models\forms\ConfigurationForm */
/* @var $this \yii\web\View */

$this->title = Yii::t('app', 'Manage Application Settings');
$settings = Yii::$app->settings;
?>
<div class="col-sm-6">
<?php $form = ActiveForm::begin(); ?>

<?php echo $form->field($model, 'appName')->textInput(['value' => $settings->get('root', 'appName')]); ?>

<?php echo $form->field($model, 'adminEmail')->textInput(['value' => $settings->get('root', 'adminEmail')]); ?>

<?php echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end(); ?>
</div>
<div class="col-sm-6">
<div class="administrator-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div></div>