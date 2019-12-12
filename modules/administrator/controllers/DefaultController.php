<?php

namespace app\modules\administrator\controllers;

use yii\web\Controller;
use app\models\forms\ConfigurationForm;
use yii;

/**
 * Default controller for the `administrator` module
 */
class DefaultController extends Controller
{
    public $layout =  '@app/modules/administrator/views/layouts/main.php';

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {  
        $model = new ConfigurationForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            return $this->render('index', ['model' => $model]);
        } else {
            return $this->render('index', ['model' => $model]);
        }
    }
}
