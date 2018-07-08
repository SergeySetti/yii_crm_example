<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m180707_102844_add_users_table
 */
class m180707_102844_add_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            'real_name' => Schema::TYPE_STRING . ' NOT NULL',
            'password' => Schema::TYPE_STRING . ' NOT NULL',
            'subscription_type' => Schema::TYPE_INTEGER,
            'auth_key' => Schema::TYPE_STRING,
            'company_name' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING,
            'country' => Schema::TYPE_STRING,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }

}
