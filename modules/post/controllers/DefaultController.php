<?php

namespace app\modules\post\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Default controller for the `post` module
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
        $permissions = Yii::$app->authManager
            ->getPermissionsByUser(\Yii::$app->user->identity->id);
        if ($permissions == NULL) {
            return $this->goHome();
        }    
        return $this->render('index', ['permissions' => $permissions]);
    }
}
