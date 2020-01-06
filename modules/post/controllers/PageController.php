<?php

namespace app\modules\post\controllers;

use Yii;
use app\models\Post;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Default controller for the `post` module
 */
class PageController extends Controller
{
    public $layout =  '@app/views/layouts/main.php';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($section = NULL)
    {
        if ($section == NULL){
            return $this->goHome();
        };
        $query = Post::find()->andWhere(['section' => $section])->asArray()->all();
        if (empty($query)){
            return $this->goHome();
        };
        return $this->render('index', ['query' => $query]);
    }
}
