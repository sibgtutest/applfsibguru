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
     * @var string address
     */
    public $address;

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['appName', 'adminEmail', 'address'], 'required'],
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
            'address' => Yii::t('app', 'Post Address'),
        ];
    }

    public function save()
    {
        /*if (!$this->validate()) {
            return null;
        }*/
        $settings = Yii::$app->settings;
        $settings->set('root', 'appName', $this->appName, '123');
        $settings->set('root', 'adminEmail', $this->adminEmail);
        $settings->set('root', 'address', $this->address);
    }
}