<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%session}}`.
 */
class m240516_054617_create_sessions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%session}}', [
            'id' => $this->primaryKey(),
            'film_id'   => $this->integer()->notNull(),
            'datetime' => $this->timestamp(),
            'price'     => $this->decimal(9,2)
        ]);
        $this->addForeignKey(
            'fk-session-film_id',
            'session',
            'film_id',
            'film',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%session}}');
    }
}
