<?php

namespace app\modules\chat\controllers;

use yii\web\Controller;
use app\modules\chat\models\Chat;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;

/**
 * Default controller for the `chat` module
 */
class DefaultController extends Controller
{
    public $layout =  '@app/modules/chat/views/layouts/main.php';
    public $childid = 0;
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
    /*public function actionIndex()
    {
        return $this->render('index');
    }*/
    public function actionIndex()
    {
        $model = new Chat();
        $userid = \Yii::$app->user->identity->id;
        //$query = Chat::findAll(['userid' => $userid])->limit(10);
        $query = (new \yii\db\Query())->select(['id', 'userid', 'childid', 'message', 'updateDate'])
            ->from('chat')
            ->where(['userid' => $userid])->orWhere(['childid' => $this->childid])
            ->orderBy('id DESC')
            ->limit(10)
            ->all();
        /*$name = (new \yii\db\Query())->select(['id', 'key_profile', 'value_profile', 'rule'])
            ->from('profile')
            ->where(['rule' => $userid])
            ->where(['key_profile' => 'Имя'])->all();
        $familyname = (new \yii\db\Query())->select(['id', 'key_profile', 'value_profile', 'rule'])
            ->from('profile')
            ->where(['rule' => $userid])
            ->where(['key_profile' => 'Фамилия'])->all(); 
        $secondname = (new \yii\db\Query())->select(['id', 'key_profile', 'value_profile', 'rule'])
            ->from('profile')
            ->where(['rule' => $userid])
            ->where(['key_profile' => 'Отчество'])->all(); */         
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            
            //return $this->render('index', ['model' => $model, 'query' => $query]);
            return $this->redirect(['index']);
        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('index', ['model' => $model, 
                                            'query' => $query]);
                                            /*'name' => $name, 
                                            'familyname' => $familyname,
                                            'secondname' => $secondname,]);*/

        }
    }
}
