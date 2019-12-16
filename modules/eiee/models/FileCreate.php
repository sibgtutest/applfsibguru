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
            [['filename'], 'file', 'extensions' => 'pdf', 'skipOnEmpty' => false],
            [['value_profile'], 'required'],
            [['value_profile'], 'string', 'max' => 255],
        ];
    }

    public function saveAcademic(String $modelfilename)
    {
        $model = new Profile();
        
        $model->name = 'Учебная работа студента';
        $model->section = 'Academic';
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