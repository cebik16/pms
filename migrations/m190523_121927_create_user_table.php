<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m190523_121927_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'firstName' => $this->string()->notNull(),
            'lastName' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'avatar' => $this->string(),
            'role' => $this->integer(),
            'auth_key' => $this->string(32)->notNull(),
            'verification_token' => $this->string(50)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
	        'created_at' => $this->integer(),
	        'updated_at' => $this->integer()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
