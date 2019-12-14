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
        return $this->render('index');
    }
}
