<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tasks`.
 */
class m181223_160341_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('tasks', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'date' => $this->dateTime()->notNull(),
            'description' => $this->text(),
            'responsible_id' => $this->integer(),

        ]);
        $this->createIndex('ix_task','tasks','responsible_id');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('tasks');
    }
}