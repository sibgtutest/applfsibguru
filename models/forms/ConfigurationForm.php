<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\record\setting;

class ConfigurationForm extends Model
{
    /**
     * @var string application name
     */
    public $appName;

    /**
     * @var string admin email
     */
    public $adminEmail;

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['appName', 'adminEmail'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return [
            'appName' => Yii::t('app', 'Application Name'),
            'adminEmail' => Yii::t('app', 'Admin Email'),
        ];
    }

    public function save()
    {
        /*if (!$this->validate()) {
            return null;
        }*/
        $settings = Yii::$app->settings;
        $settings->set('root', 'appName', $this->appName);
        $settings->set('root', 'adminEmail', $this->adminEmail);

    }
}