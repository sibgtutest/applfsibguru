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
 * AcademicController implements the CRUD actions for Profile model.
 */
class AcademicController extends Controller
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
    public function actionIndex($section = NULL)
    {
        if ($section == NULL){
            return $this->goHome();
        };
        $desc = Profile::find()->where(['key_profile' => $section])->One();
        if ($desc['value_profile'] == NULL){
            return $this->goHome();
        };
        $userid = \Yii::$app->user->identity->id;
        $query = Profile::find()->where(['rule' => $userid, 'section' => $section]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query, 
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'section' => $section,
            'desc' => $desc['value_profile'],
        ]);
    }

    /**
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($section = NULL)
    {
        if ($section == NULL){
            return $this->goHome();
        };
        $desc = Profile::find()->where(['key_profile' => $section])->One();
        if ($desc['value_profile'] == NULL){
            return $this->goHome();
        };
        $model = new FileCreate();
        $userid= \Yii::$app->user->identity->id;
        
        if(Yii::$app->request->post()) {
             $model->load(Yii::$app->request->post());
             
             $model->filename = UploadedFile::getInstance($model, 'filename');
             
             if ($model->validate()) {
                  $path = Yii::$app->params['pathUploads'] . $userid . '/';
                  $filename = $model->filename;
                  $model->filename->saveAs( $path . $section . '_' . $filename);
                  $model->save_($section, $filename);
                  return $this->redirect([$section . '/index', 'section' => $section]);
             }
        }
        return $this->render('create', [
            'model' => $model,
            'desc' => $desc['value_profile'],
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
        $userid= \Yii::$app->user->identity->id;
        if ($dataProvider['rule'] <> $userid){
            return $this->goHome();
        }; 
        $filename = $dataProvider->key_profile;
        $i = \Yii::$app->user->identity->id;
        $file = \Yii::$app->params['pathUploads'] . $i . '/' . $dataProvider->section . '_' . $filename;
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
        if ($model['rule'] <> $userid){
            return $this->goHome();
        }; 
        $desc = Profile::find()->where(['key_profile' => $model['section']])->One();
        if ($desc['value_profile'] == NULL){
            return $this->goHome();
        };        
        if ($desc['rule'] == NULL){
            return $this->goHome();
        };
        $dataProvider = new ActiveDataProvider([
            'query' => Profile::find()->where(['rule' => $userid]),
        ]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->redirect(
                \yii\helpers\Url::toRoute([
                    '/eiee/'.$model['section'].'/index', 
                    'dataProvider' => $dataProvider]));
        }
        return $this->render('update', [
                'model' => $model,
                'section' => $model['section'],
                'desc' => $desc['value_profile'],
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
        $model = $this->findModel($id);
        $userid= \Yii::$app->user->identity->id;
        if ($model['rule'] <> $userid){
            return $this->goHome();
        }; 
        $path = \Yii::$app->params['pathUploads'] . $userid . '/';
        unlink( $path . $model['section'] . '_' . $this->findModel($id)->key_profile );

        $model->delete();
        //return $this->redirect(['index']);
        return $this->redirect([$model['section'] . '/index', 'section' => $model['section']]);
    }

    public function actionSave($id)
    {
        $model = $this->findModel($id);
        $userid= \Yii::$app->user->identity->id;
        if ($model['rule'] <> $userid){
            return $this->goHome();
        }; 
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
