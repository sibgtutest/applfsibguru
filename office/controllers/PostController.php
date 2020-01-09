<?php

namespace app\controllers;

use Yii;
use app\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    //public $layout =  '@app/post/views/layouts/main.php';
    /**
     * {@inheritdoc}
    */ 
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index,create,update'],
                'rules' => [
                    [
                        'actions' => ['index,create,update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],  
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['view,delete'],
                'rules' => [
                    [
                        'actions' => ['view,delete'],
                        'allow' => false,
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

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex($section = NULL)
    {
        if ($section == NULL){
            return $this->goHome();
        };
        if (!Yii::$app->user->can($section)) {
            return $this->goHome();
        }

        return $this->render('index', [
            'dataProvider' => $this->getDataProvider($section),
            'section' => $section,
            'description' => $this->getDesc($section),
        ]);
    }
    protected function getDataProvider($section)
    {
        $query = Post::find()->andWhere(['section' => $section]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($section = NULL)
    {
        if (!Yii::$app->user->can($section)) {
            return $this->goHome();
        }        
        //$model = new Post();
        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['post/index', 'section' => $section]);
        }

        return $this->render('create', [
            'model' => $model,
            'section' => $section,
            'description' => $this->getDesc($section),
        ]);
    }
    protected function getDesc($section)
    {
        $permissions = Yii::$app->authManager
            ->getPermissionsByUser(\Yii::$app->user->identity->id);
        foreach($permissions as $key => $perm){ 
            if ($perm->name == $section) {
                return $perm->description;  
            }  
       }
    }    

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if (!Yii::$app->user->can($model->section)) {
            return $this->goHome();
        }     

        return $this->render('view', [
            'model' => $model,
            'section' => $model->section,
            'description' => $this->getDesc($model->section),
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (!Yii::$app->user->can($model->section)) {
            return $this->goHome();
        }  
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([
                'post/index', 
                'section' => $model->section,
            ]);
        }

        return $this->render('update', [
            'model' => $model,
            'section' => $model->section,
            'description' => $this->getDesc($model->section),
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        if (!Yii::$app->user->can($model->section)) {
            return $this->goHome();
        }  
        return $this->redirect(['post/index', 'section' => $model->section]);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
