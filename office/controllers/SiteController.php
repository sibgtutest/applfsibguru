<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;

class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //return $this->render('index');
        $permissions = Yii::$app->authManager
            ->getPermissionsByUser(\Yii::$app->user->id);
        if ($permissions == NULL) {
            //return $this->goHome();///////////////
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

    public function actionError()
    {
        return $this->render('error'); 
    }          
}
