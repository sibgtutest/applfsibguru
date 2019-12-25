<?php

namespace app\modules\administrator\controllers;

use yii\web\Controller;
use app\models\forms\ConfigurationForm;
use Yii;
use yii\filters\AccessControl;
use app\modules\administrator\models\SignupForm;

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
                'only' => ['index', 'signup'],
                'rules' => [
                    [
                        'actions' => ['index', 'signup'],
                        'allow' => true,
                        'roles' => ['admin'],
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
    /**
     * Форма регистрации.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }    
}
