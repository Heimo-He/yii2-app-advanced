<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'access_token' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->initSql();
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }

    public function initSql(){
        $security = Yii::$app->security;
        $columns = ['email', 'username', 'password_hash', 'status', 'created_at', 'access_token', 'auth_key'];

        $this->batchInsert('{{%user}}', $columns, [
            [
                'admin@test.com',
                'admin',
                $security->generatePasswordHash('admin_2018'), // admin
                10,
                date('Y-m-d H:i:s'),
                $security->generateRandomString(),
                $security->generateRandomString()
            ],
        ]);
    }
}
