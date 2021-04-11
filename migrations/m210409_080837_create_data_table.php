<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%data}}`.
 */
class m210409_080837_create_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%data}}', [
            'id' => $this->primaryKey(),
            'user_name' => $this->string(100),
            'fio'  => $this->string(50),
            'post' => $this->string(50),
            'start_vacation'  => $this->string(100),
            'end_vacation' => $this->string(100),
            'fixed' => $this->string(20)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%data}}');
    }
}
