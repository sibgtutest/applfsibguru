<?php

namespace app\modules\eiee\models;

use Yii;
use yii\base\Model;
use app\modules\eiee\models\Profile;

class FileCreate extends Model
{ 
    public $filename;
    public $value_profile;

    public function rules()
    {
        return [
            [['filename'], 'file', 'extensions' => 'pdf', 'skipOnEmpty' => false, 'on'=>'update'],
            [['value_profile'], 'required'],
            [['value_profile'], 'string', 'max' => 255],
            ['filename', 'validateFilename'],
        ];
    }
    public function validateFilename()
    {
        $model = Profile::find()->where(['key_profile' => $this->filename])->One();
        if ($model) {
            $this->addError('filename', 'Файл <'.$this->filename.'> уже создан. Переименуйте и создайте снова.');
        }        
    }
    public function saveAcademic(String $section, String $modelfilename)
    {
        $model = new Profile();
       // $model->name = $this->getModelName($section);
        $model->name = 'Учебная работа студента';
        $model->section = $section;
        $model->key_profile = $modelfilename;
        $model->value_profile = $this->value_profile;
        $model->status = '1';
        $model->rule = Yii::$app->user->getId().'';
        $model->tag = '1';
        $model->createdAt = date('Y-m-d H:i:s');
        $model->updatedAt = date('Y-m-d H:i:s');
        $model->save();
    }
    public function save_(String $section, String $modelfilename)
    {
        $model = new Profile();
       // $model->name = $this->getModelName($section);
        $model->name = 'Учебная работа студента';
        $model->section = $section;
        $model->key_profile = $modelfilename;
        $model->value_profile = $this->value_profile;
        $model->status = '1';
        $model->rule = Yii::$app->user->getId().'';
        $model->tag = '1';
        $model->createdAt = date('Y-m-d H:i:s');
        $model->updatedAt = date('Y-m-d H:i:s');
        $model->save();
    }    
    protected function getModelName(String $section)
    {
        $model = Profile::find()->where(['key_profile' => $section])->One();
        return $model['value_profile'];
    }
    public function savePaper(String $modelfilename)
    {
        $model = new Profile();
        
        $model->name = 'Учебная работа студента';
        $model->section = 'Paper';
        $model->key_profile = $modelfilename;
        $model->value_profile = $this->value_profile;
        $model->status = '1';
        $model->rule = Yii::$app->user->getId().'';
        $model->tag = '1';
        $model->createdAt = date('Y-m-d H:i:s');
        $model->updatedAt = date('Y-m-d H:i:s');
        //var_dump($model);
        $model->save();
    }
    public function savePlan(String $modelfilename)
    {
        $model = new Profile();
        
        $model->name = 'Учебная работа студента';
        $model->section = 'Plan';
        $model->key_profile = $modelfilename;
        $model->value_profile = $this->value_profile;
        $model->status = '1';
        $model->rule = Yii::$app->user->getId().'';
        $model->tag = '1';
        $model->createdAt = date('Y-m-d H:i:s');
        $model->updatedAt = date('Y-m-d H:i:s');
        //var_dump($model);
        $model->save();
    }  
    public function savePublic(String $modelfilename)
    {
        $model = new Profile();
        
        $model->name = 'Учебная работа студента';
        $model->section = 'Public';
        $model->key_profile = $modelfilename;
        $model->value_profile = $this->value_profile;
        $model->status = '1';
        $model->rule = Yii::$app->user->getId().'';
        $model->tag = '1';
        $model->createdAt = date('Y-m-d H:i:s');
        $model->updatedAt = date('Y-m-d H:i:s');
        //var_dump($model);
        $model->save();
    }    
    public function saveScientific(String $modelfilename)
    {
        $model = new Profile();
        
        $model->name = 'Учебная работа студента';
        $model->section = 'Scientific';
        $model->key_profile = $modelfilename;
        $model->value_profile = $this->value_profile;
        $model->status = '1';
        $model->rule = Yii::$app->user->getId().'';
        $model->tag = '1';
        $model->createdAt = date('Y-m-d H:i:s');
        $model->updatedAt = date('Y-m-d H:i:s');
        //var_dump($model);
        $model->save();
    }  
    public function saveSport(String $modelfilename)
    {
        $model = new Profile();
        
        $model->name = 'Учебная работа студента';
        $model->section = 'Sport';
        $model->key_profile = $modelfilename;
        $model->value_profile = $this->value_profile;
        $model->status = '1';
        $model->rule = Yii::$app->user->getId().'';
        $model->tag = '1';
        $model->createdAt = date('Y-m-d H:i:s');
        $model->updatedAt = date('Y-m-d H:i:s');
        //var_dump($model);
        $model->save();
    }   
}    