<?php

namespace app\modules\eiee\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Default controller for the `eiee` module
 */
class DefaultController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['profile'],
                'rules' => [
                    [
                        'actions' => ['profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }    
    public $layout =  '@app/modules/eiee/views/layouts/main.php';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    /**
     * Renders the profile view for the module
     * @return string
     */
    public function actionProfile()
    {
        return $this->render('profile');
    }    
}
