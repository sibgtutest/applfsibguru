<?php

namespace app\modules\administrator\controllers;

use yii\web\Controller;
use app\models\forms\ConfigurationForm;
use Yii;
use yii\filters\AccessControl;

/**
 * Default controller for the `administrator` module
 */
class DefaultController extends Controller
{
    public $layout =  '@app/modules/administrator/views/layouts/main.php';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {  
        return $this->render('index');
    }
}
