<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%setting}}`.
 */
class m191212_060853_create_setting_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%setting}}', [
            'id_setting' => $this->primaryKey(),
            'type_setting' => $this->string(10)->notNull(),
            'section_setting' => $this->string()->notNull(),
            'key_setting' => $this->string()->notNull(),
            'value_setting' => $this->text()->notNull(),
            'status_setting' => $this->smallInteger()->notNull()->defaultValue(1),
            'createdAt_setting' => $this->integer()->notNull(),
            'updatedAt_setting' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%setting}}');
    }
}
