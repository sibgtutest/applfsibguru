<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Post;

class SiteController extends Controller
{
   
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }  

    public function actionDefault()
    {
        return $this->redirect(['site/index', 'section' => 'viewAAAAAAAAAAaPage']);
    }   
     
    /**
     * Displays homepage.
     *
     * @return string
    */ 
    public function actionIndex($section = NULL)
    {  
        if ($section == NULL){
            return $this->goHome();
        };    
        $query = $this->getQuery($section);
        if ($query == NULL){
            return $this->goHome();
            return 'goHome';
        };
        $xml = $this->getXml($query);
        $result = $this->getResultDoc($xml);
        //
        //return 'ok';
        return $this->render('index', ['result' => $result]);
    }

    protected function getResultDoc($xml)
    {
        try {
            $xmlDoc = \DOMDocument::loadXML($xml);
            $xslDoc = \DomDocument::load(Yii::getAlias('@app').'/templates/1.xsl');
            $proc = new \XSLTProcessor();
            $proc->importStyleSheet($xslDoc);
            $result = $proc->transformToXML($xmlDoc);
        } catch (\Exception $e) {
            $result = 'Load error';
        } 
        /*
        * Sate to file
        */
        //$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        //fwrite($myfile, $result);
        //fclose($myfile);
        //
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
