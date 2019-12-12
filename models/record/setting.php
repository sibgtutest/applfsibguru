<?php
namespace app\models\record;
use Yii;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "setting".
 *
 * @property int $id
 * @property string $type
 * @property string $section
 * @property string $key
 * @property string $value
 * @property int $status
 * @property string $description
 * @property int $created_at
 * @property int $updated_at
 */
class Setting extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'setting';
    }
}