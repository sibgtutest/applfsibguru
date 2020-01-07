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
        $query = $this->getQuery($section);
        if (empty($query)){
            return $this->goHome();
        };
        $xml = $this->getXml($query);
        $result = $this->getResultDoc($xml);
        return $this->render('index', ['result' => $result]);
    }

    protected function getResultDoc($xml)
    {
        $xmlDoc = \DOMDocument::loadXML($xml);
        $xslDoc = \DomDocument::load(Yii::getAlias('@app').'/templates/1.xsl');
        $proc = new \XSLTProcessor();
        $proc->importStyleSheet($xslDoc);
        $result = $proc->transformToXML($xmlDoc);
        return $result;
    }

    protected function getXml($query)
    {
        $xml = '<root>';
        foreach ($query as $value){
            /*if ($value['key_post'] == 'Заголовок' && $value['status'] == 0) {
                $xml .= '<'.$value['key_post'].'>' . $value['value_post'] . '</'.$value['key_post'].'>';
            };
            if ($value['key_post'] == 'Абзац' && $value['status'] == 0) {
                $xml .= '<'.$value['key_post'].'>' . $value['value_post'] . '</'.$value['key_post'].'>';
            };*/
            if ($value['status'] == 0) {
                $xml .= '<'.$value['key_post'].'>' . $value['value_post'] . '</'.$value['key_post'].'>';
            };
        };
        $xml .= '</root>';
        
        return $xml;
    }

    protected function getQuery($section)
    {
        $query = Post::find()->andWhere(['section' => $section])->asArray()->all();
        return $query;
    }
}
