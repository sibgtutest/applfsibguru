<?php

namespace app\controllers;

use Yii;
use app\models\Rule;
use app\models\Staf;
use app\models\RuleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * RuleController implements the CRUD actions for Rule model.
 */
class RuleController extends Controller
{
    /**
     * {@inheritdoc}
    */ 
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['init', 'index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['init', 'index', 'view', 'create', 'update', 'delete'],
                        'allow'=> true,
                        'roles' => ['viewAdminPage'],
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

    public function actionInit()
    {
        $rules = Rule::find()->select(['role'])->distinct()->all();
        $stafs = Staf::find()->all();

        $auth = \Yii::$app->authManager;

        $auth->removeAll(); //На всякий случай удаляем старые данные из БД...

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';
        $auth->add($viewAdminPage);
        $auth->addChild($admin, $viewAdminPage);
        $auth->assign($admin, 1); 

        foreach ($rules as $rule){
            $roles = Rule::find()->where(['role' => $rule])->all();
            $role1 = $auth->createRole($rule->role);
            $auth->add($role1); 
            foreach ($roles as $role){
                $perm = $auth->createPermission($role->permissions);
                $perm->description = $role->description;  
                $auth->add($perm);
                $auth->addChild($role1, $perm);
            }
            $auth->assign($role1, (Staf::findByUsername($rule->role))->getId()); 

        }
        return $this->redirect(['index']);  
    }    

    /**
     * Lists all Rule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RuleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rule model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Rule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rule();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']); 
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Rule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']); 
        }
         
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Rule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rule::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
}
