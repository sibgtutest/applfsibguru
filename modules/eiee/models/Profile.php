<?php

namespace app\modules\eiee\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property string $name
 * @property string $section
 * @property string $key_profile
 * @property string $value_profile
 * @property string $status
 * @property string $rule
 * @property string $tag
 * @property string $createdAt
 * @property string $updatedAt
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'section', 'key_profile', 'value_profile', 'status', 'rule', 'tag', 'createdAt', 'updatedAt'], 'required'],
            [['name', 'section', 'key_profile', 'value_profile', 'status', 'rule', 'tag', 'createdAt', 'updatedAt'], 'string', 'max' => 255],
            [['key_profile'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'section' => 'Section',
            'key_profile' => 'Имя файла',
            'value_profile' => 'Описание',
            'status' => 'Status',
            'rule' => 'Rule',
            'tag' => 'Tag',
            'createdAt' => 'Создан в',
            'updatedAt' => 'Обновлен в',
        ];
    }
}
