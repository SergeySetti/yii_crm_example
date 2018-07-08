<?php

use yii\db\Migration;

/**
 * Handles the creation of table `clients`.
 */
class m180708_100458_create_clients_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('clients', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'status' => "ENUM('Active', 'Inactive', 'Blacklisted')",
            'country' => $this->string()->notNull(),
            'note' => $this->text(),
        ]);

        $this->createIndex(
            'idx-client-user',
            'clients',
            'user_id'
        );

        $this->addForeignKey(
            'fk-client-user_id',
            'clients',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('clients');
    }
}
