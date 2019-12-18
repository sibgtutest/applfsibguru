<?php

namespace app\modules\chat\controllers;

use yii\web\Controller;
use app\modules\chat\models\Chat;
use yii\widgets\ActiveForm;

/**
 * Default controller for the `chat` module
 */
class DefaultController extends Controller
{
    public $layout =  '@app/modules/chat/views/layouts/main.php';
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
        $query = (new \yii\db\Query())->select(['id', 'userid', 'message', 'updateDate'])
            ->from('chat')
            ->where(['userid' => $userid])
            ->orderBy('id DESC')
            ->limit(10)
            ->all();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            
            //return $this->render('index', ['model' => $model, 'query' => $query]);
            return $this->redirect(['index']);
        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('index', ['model' => $model, 'query' => $query]);

        }
    }
}
