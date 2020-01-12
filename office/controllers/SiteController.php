<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
    */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'index', 'login', 'error'],
                'rules' => [
                    [
                        'actions' => ['logout', 'login', 'error'],
                        'allow' => true,
                    ],                   
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    } 
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }    
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //return $this->render('index');
        if (\Yii::$app->user->id == NULL) {
            return $this->redirect(['login']);
        }
        $permissions = Yii::$app->authManager
            ->getPermissionsByUser(\Yii::$app->user->id);
        if ($permissions == NULL) {
            //return $this->goHome();///////////////
            //return $this->redirect(['login']);
            Yii::$app->user->logout();
            return $this->redirect(['login']);
        }    
        return $this->render('index', ['permissions' => $permissions]);        
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    } 

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
        
    }    
/*
    public function actionError()
    {
        return $this->render('error'); 
    }          
*/
}
