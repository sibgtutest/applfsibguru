<?php

namespace app\modules\eiee\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\modules\eiee\models\Profile;
use yii\data\ActiveDataProvider;

/**
 * Default controller for the `eiee` module
 */
class DefaultController extends Controller
{
    public $title;

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
                        'actions' => ['profile', 'paper'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }    

    public $layout =  '@app/modules/eiee/views/layouts/main.php';

    /**
     * Renders the index view for the module
     * 
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Renders the paper view for the module
     * 
     * @return mixed
     */
    public function actionPaper()
    {
        $userid = \Yii::$app->user->identity->id;
        $query = Profile::find()->where(['rule' => $userid, 'section' => 'Paper']);
        $this->title = 'Статьи студента';
        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        return $this
            ->render(
                'main', ['dataProvider' => $dataProvider,'title' => $this->title]
            );
    }

    /**
     * Renders the paper view for the module
     * 
     * @return mixed
     */
    public function actionProfile()
    {
        $userid = \Yii::$app->user->identity->id;
        $dataProvider 
            = new ActiveDataProvider(
                ['query' => Profile::find()
                    ->where(['section' => 'Profile'])
                    ->andWhere(['rule' => $userid]),]
            );

        return $this->render('profile', ['dataProvider' => $dataProvider,]);
    }

    /**
     * Lists all Profile models.
     * 
     * @return mixed
     */
    public function actionPublic()
    {
        $userid = \Yii::$app->user->identity->id;
        $query = Profile::find()
            ->where(['rule' => $userid, 'section' => 'Public']);
        $this->title = 'Общественные достижения студента';
        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        return $this
            ->render(
                'main', ['dataProvider' => $dataProvider,'title' => $this->title]
            );
    }

    /**
     * Lists all Profile models.
     * 
     * @return mixed
     */
    public function actionScientific()
    {
        $userid = \Yii::$app->user->identity->id;
        $query = Profile::find()
            ->where(['rule' => $userid, 'section' => 'Scientific']);
        $this->title = 'Научные достижения студента';
        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        return $this
            ->render(
                'main', ['dataProvider' => $dataProvider,'title' => $this->title]
            );
    }

    /**
     * Lists all Profile models.
     * 
     * @return mixed
     */
    public function actionSport()
    {
        $userid = \Yii::$app->user->identity->id;
        $query = Profile::find()
            ->where(['rule' => $userid, 'section' => 'Sport']);
        $this->title = 'Спортивные достижения студента';
        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        return $this
            ->render(
                'main', ['dataProvider' => $dataProvider,'title' => $this->title]
            );
    }    

    /**
     * Renders the profile view for the module
     * 
     * @return string
    */ 
    public function actionProfile1()
    {
        return $this->render('profile1');
    }    

}
