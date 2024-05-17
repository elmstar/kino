<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%films}}`.
 */
class m240516_054603_create_films_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%films}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128),
            'photo' => $this->string(4)->defaultValue(''),
            'description' => $this->text(),
            'duration'  => $this->smallInteger()->defaultValue(0),
            'age'         => $this->tinyInteger()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%films}}');
    }
}
