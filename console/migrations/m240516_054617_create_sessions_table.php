<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sessions}}`.
 */
class m240516_054617_create_sessions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sessions}}', [
            'id' => $this->primaryKey(),
            'film_id'   => $this->integer()->notNull(),
            'datetime' => $this->timestamp(),
            'price'     => $this->decimal(9,2)
        ]);
        $this->addForeignKey(
            'fk-sessions-film_id',
            'sessions',
            'film_id',
            'films',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sessions}}');
    }
}
