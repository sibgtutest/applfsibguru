<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Post;

class SiteController extends Controller
{
    public function actionDefault()
    {
        return $this->redirect(['site/index', 'section' => 'its']);
    }    
    /**
     * Displays homepage.
     *
     * @return string
    */ 
    public function actionIndex($section = NULL)
    {
        /*if ($section == NULL){
            return $this->goHome();
        }; */       
        $query = $this->getQuery($section);
        /*if (empty($query)){
            return $this->goHome();
            return 'goHome';
        };*/
        $xml = $this->getXml($query);
        $result = $this->getResultDoc($xml);
        
        return $this->render('index', ['result' => $result]);

        //return 'index';
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
    public function actionError()
    {
        return $this->render('error'); 
    }       
}
