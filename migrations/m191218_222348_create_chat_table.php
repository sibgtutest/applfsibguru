<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chat}}`.
 * 
// CREATE TABLE `chat` (
//   `id` INT(11) NOT NULL AUTO_INCREMENT,
//   `userId` INT(11) DEFAULT NULL,
//   `message` TEXT,
//   `updateDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//   PRIMARY KEY (`id`)
// ) ENGINE=INNODB;
 * 
 */
class m191218_222348_create_chat_table extends Migration
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

        $this->createTable('{{%chat}}', [
            'id' => $this->primaryKey(),
            'userid' => $this->integer(),
            'childid' => $this->integer(),
            'message' => $this->string(255),
            'updateDate' => $this->timestamp()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%chat}}');
    }
}
