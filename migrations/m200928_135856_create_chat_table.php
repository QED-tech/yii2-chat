<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chat}}`.
 */
class m200928_135856_create_chat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%chat}}', [
            'id' => $this->primaryKey(),
            'text' => $this->text(),
            'is_correct' => $this->integer()->notNull(),
            'author_id' => $this->smallInteger(),

            'created_at' => $this->dateTime()
        ]);


        $this->addForeignKey(
            'fk-chat-author_id',
            'chat',
            'author_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%chat}}');
    }
}
