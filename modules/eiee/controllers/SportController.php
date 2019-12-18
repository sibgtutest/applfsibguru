<?php

namespace app\modules\eiee\controllers;

use Yii;
use app\modules\eiee\models\Profile;
use app\modules\eiee\models\ProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\eiee\models\FileCreate;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

/**
 * SportController implements the CRUD actions for Profile model.
 */
class SportController extends Controller
{
    public $layout =  '@app/modules/eiee/views/layouts/main.php';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index,view,create,update,delete'],
                'rules' => [
                    [
                        'actions' => ['index,view,create,update,delete'],
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

    /**
     * Lists all Profile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $userid = \Yii::$app->user->identity->id;
        $query = Profile::find()->where(['rule' => $userid, 'section' => 'Sport']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query, 
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Profile model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $dataProvider = Profile::find()->where(['id' => $id])->limit(1)->one();
        $filename = $dataProvider->key_profile;
        $i = \Yii::$app->user->identity->id;
        $file = \Yii::$app->params['pathUploads'] . $i . '/' . 'Sport_' . $filename;
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        echo file_get_contents($file);
        exit;
    }

    /**
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FileCreate();
        $userid= \Yii::$app->user->identity->id;
        
        if(Yii::$app->request->post()) {
             $model->load(Yii::$app->request->post());
             
             $model->filename = UploadedFile::getInstance($model, 'filename');
             
             if ($model->validate()) {
                  $path = Yii::$app->params['pathUploads'] . $userid . '/';
                  $filename = $model->filename;
                  $model->filename->saveAs( $path . 'Sport_' . $filename);
                  $model->saveSport($filename);
                  return $this->redirect(['sport/index']);
             }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $userid= \Yii::$app->user->identity->id;
        $dataProvider = new ActiveDataProvider([
            'query' => Profile::find()->where(['rule' => $userid]),
        ]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->redirect(
                \yii\helpers\Url::toRoute([
                    '/eiee/sport/index', 
                    'dataProvider' => $dataProvider]));
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Profile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $userid= \Yii::$app->user->identity->id;
        $path = \Yii::$app->params['pathUploads'] . $userid . '/';
        unlink( $path . 'Sport_' . $this->findModel($id)->key_profile );

        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionSave($id)
    {
        \Yii::$app->db->createCommand()
             ->update('profile', ['status' => 0], ['id' => $id])
             ->execute();
        return $this->redirect(['index']);
    } 

    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
