<?php

use yii\db\Migration;

/**
 * Handles the creation of table `payment_methods`.
 */
class m180708_141128_create_payment_methods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('payment_methods', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'name' => $this->string(),
            'type' => "ENUM('PayPal', 'Skrill', 'Bank transfer')",
            'description' => $this->text(),
        ]);

        $this->createIndex(
            'idx-payment_method-user',
            'payment_methods',
            'user_id'
        );

        $this->addForeignKey(
            'fk-payment_method-user_id',
            'payment_methods',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );

        $this->addColumn('clients', 'payment_method_id', $this->integer());

        $this->addForeignKey(
            'fk-users-payment_method_id',
            'clients',
            'payment_method_id',
            'payment_methods',
            'id',
            'SET NULL'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('payment_methods');
        $this->dropForeignKey('fk-users-payment_method_id', 'clients');
        $this->dropColumn('clients', 'payment_method_id');
    }
}
