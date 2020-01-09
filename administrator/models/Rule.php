<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rule".
 *
 * @property int $id
 * @property string $role
 * @property string $permissions
 * @property string $description
 */
class Rule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role', 'permissions', 'description'], 'required'],
            [['description'], 'string'],
            [['role', 'permissions'], 'string', 'max' => 255],
            [['permissions'], 'unique'],
            ['permissions', 'match', 'pattern' => '/^[a-z]\w*$/i'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role' => 'Role',
            'permissions' => 'Permissions',
            'description' => 'Description',
        ];
    }
}
