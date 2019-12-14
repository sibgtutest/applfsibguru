<?php

namespace app\modules\manager\controllers;

use yii\web\Controller;

/**
 * Default controller for the `manager` module
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
