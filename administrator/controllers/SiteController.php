<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\SignStud;
use app\models\SignStaf;
use app\models\User;
use app\models\Stud;
use app\models\Staf;
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
                'only' => ['logout', 'signup', 'index', 'login', 'signstud', 'signstaf', 'error'],
                'rules' => [
                    [
                        'actions' => ['logout', 'login', 'error'],
                        'allow' => true,
                    ],                   
                    [
                        'actions' => ['signup', 'index', 'signstud', 'signstaf'],
                        'allow' => true,
                        'roles' => ['viewAdminPage'],
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $amdins = User::find('username', 'email')->all();
        $stafs = Staf::find('username','email')->all();
        $studs = Stud::find('username','email')->all();
        $permissions = [];
        foreach ($stafs as $staf){
            $id = (Staf::findByUsername($staf->username))->getId();
            array_push($permissions, [$staf->username => Yii::$app->authManager->getPermissionsByUser($id)]);
        }
        

        return $this->render('index', [
            'amdins' => $amdins, 
            'studs' => $studs,
            'stafs' => $stafs,
            'permissions' => $permissions,
        ]);
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

    /**
     * Форма регистрации.
     *
     * @return mixed
     */
    public function actionSignstud()
    {
        $model = new SignStud();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                return $this->goHome();
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    } 

    /**
     * Форма регистрации.
     *
     * @return mixed
     */
    public function actionSignstaf()
    {
        $model = new SignStaf();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                return $this->goHome();
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    } 
    public function actionError()
    {
        return $this->render('error'); 
    }      
}
