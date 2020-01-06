<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $name
 * @property string $section
 * @property string $key_post
 * @property string $value_post
 * @property int $status
 * @property string $rule
 * @property string $tag
 * @property string $updatedAt
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'section', 'key_post', 'value_post', 'rule', 'tag', 'updatedAt'], 'required'],
            [['value_post', 'updatedAt'], 'string'],
            [['status'], 'integer'],
            ['value_post', 'match', 'pattern' => '/[\$<>]/i', 'not' => 'true'],
            [['name', 'section', 'key_post', 'rule', 'tag'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag' => '№',
            'name' => 'Name',
            'section' => 'Section',
            'key_post' => 'Тег',
            'value_post' => 'Отображаемый текст',
            'status' => 'Показать',
            'rule' => 'Rule',
            
            'updatedAt' => 'Изменения',
        ];
    }
}
