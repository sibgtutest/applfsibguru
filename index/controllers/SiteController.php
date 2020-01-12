<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Post;
use yii2tech\filedb\Query;

class SiteController extends Controller
{
    public function actionDefault()
    {
        return $this->redirect(['site/index', 'section' => 'news']);
    }   
     
    /**
     * Displays homepage.
     *
     * @return string
    */ 
    public function actionIndex($section = NULL)
    {  
        $query = $this->getQuery($section);
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
