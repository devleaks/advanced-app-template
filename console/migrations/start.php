<?php

use yii\db\Schema;
use yii\db\Migration;

class m_start extends Migration
{
    public function safeUp()
    {
		$tableOptions = 'ENGINE=InnoDB';
		$connection=Yii::$app->db;
		$transaction=$connection->beginTransaction();
		try{

            $this->createTable('{{%backup}}',
        [
                'id'=> Schema::TYPE_PK.'',
                'filename'=> Schema::TYPE_STRING.'(250) NOT NULL',
                'note'=> Schema::TYPE_STRING.'(160)',
                'status'=> Schema::TYPE_STRING.'(20) NOT NULL',
                'created_at'=> Schema::TYPE_DATETIME.'',
                ], $tableOptions);

            $this->createTable('{{%media}}',
        [
                'id'=> Schema::TYPE_PK.'',
                'name'=> Schema::TYPE_STRING.'(80)',
                'size'=> Schema::TYPE_INTEGER.'(11)',
                'type'=> Schema::TYPE_STRING.'(80)',
                'related_id'=> Schema::TYPE_INTEGER.'(11)',
                'related_class'=> Schema::TYPE_STRING.'(160)',
                'related_attribute'=> Schema::TYPE_STRING.'(160)',
                'name_hash'=> Schema::TYPE_STRING.'(255)',
                'status'=> Schema::TYPE_STRING.'(20)',
                'created_at'=> Schema::TYPE_DATETIME.'',
                'updated_at'=> Schema::TYPE_DATETIME.'',
                ], $tableOptions);

            $this->createTable('{{%migration}}',
        [
                'version'=> Schema::TYPE_STRING.'(180) NOT NULL',
                'apply_time'=> Schema::TYPE_INTEGER.'(11)',
                ], $tableOptions);

            $this->createTable('{{%profile}}',
        [
                'user_id'=> Schema::TYPE_INTEGER.'(11) NOT NULL',
                'name'=> Schema::TYPE_STRING.'(255)',
                'public_email'=> Schema::TYPE_STRING.'(255)',
                'gravatar_email'=> Schema::TYPE_STRING.'(255)',
                'gravatar_id'=> Schema::TYPE_STRING.'(32)',
                'location'=> Schema::TYPE_STRING.'(255)',
                'website'=> Schema::TYPE_STRING.'(255)',
                'bio'=> Schema::TYPE_TEXT.'',
                ], $tableOptions);

            $this->createTable('{{%social_account}}',
        [
                'id'=> Schema::TYPE_PK.'',
                'user_id'=> Schema::TYPE_INTEGER.'(11)',
                'provider'=> Schema::TYPE_STRING.'(255) NOT NULL',
                'client_id'=> Schema::TYPE_STRING.'(255) NOT NULL',
                'data'=> Schema::TYPE_TEXT.'',
                ], $tableOptions);

			$this->createIndex('account_unique', '{{%social_account}}','provider,client_id',1);
			$this->createIndex('user_id_idx', '{{%social_account}}','user_id',0);

            $this->createTable('{{%token}}',
        [
                'user_id'=> Schema::TYPE_INTEGER.'(11) NOT NULL',
                'code'=> Schema::TYPE_STRING.'(32) NOT NULL',
                'type'=> Schema::TYPE_SMALLINT.'(6) NOT NULL',
                'created_at'=> Schema::TYPE_INTEGER.'(11) NOT NULL',
                ], $tableOptions);

			$this->createIndex('token_unique', '{{%token}}','user_id,code,type',1);

            $this->createTable('{{%user}}',
        [
                'id'=> Schema::TYPE_PK.'',
                'username'=> Schema::TYPE_STRING.'(25) NOT NULL',
                'email'=> Schema::TYPE_STRING.'(255) NOT NULL',
                'password_hash'=> Schema::TYPE_STRING.'(60) NOT NULL',
                'auth_key'=> Schema::TYPE_STRING.'(32) NOT NULL',
                'confirmed_at'=> Schema::TYPE_INTEGER.'(11)',
                'unconfirmed_email'=> Schema::TYPE_STRING.'(255)',
                'blocked_at'=> Schema::TYPE_INTEGER.'(11)',
                'role'=> Schema::TYPE_STRING.'(255)',
                'registration_ip'=> Schema::TYPE_BIGINT.'(20)',
                'flags'=> Schema::TYPE_INTEGER.'(11) NOT NULL DEFAULT "0"',
                'created_at'=> Schema::TYPE_INTEGER.'(11) NOT NULL',
                'updated_at'=> Schema::TYPE_INTEGER.'(11) NOT NULL',
                ], $tableOptions);

            $this->createIndex('username', '{{%user}}','username',1);
            $this->createIndex('email', '{{%user}}','email',1);

            $this->addForeignKey('fk_social_account_user_id', '{{%social_account}}', 'user_id', 'user', 'id');
            $this->addForeignKey('fk_token_user_id', '{{%token}}', 'user_id', 'user', 'id');

            $transaction->commit();
		} catch (Exception $e) {
			echo 'Catch Exception '.$e->getMessage().' and rollBack this';
		    $transaction->rollBack();
		}
    }

    public function safeDown()
    {
		$connection=Yii::$app->db;
		$transaction=$connection->beginTransaction();
		try{
			$this->dropForeignKey('fk_social_account_user_id', '{{%social_account}}');
			$this->dropForeignKey('fk_token_user_id', '{{%token}}');
		    $this->dropTable('{{%backup}}');
		    $this->dropTable('{{%media}}');
		    $this->dropTable('{{%migration}}');
		    $this->dropTable('{{%profile}}');
		    $this->dropTable('{{%social_account}}');
		    $this->dropTable('{{%token}}');
		    $this->dropTable('{{%user}}');
			$transaction->commit();
		} catch (Exception $e) {
			echo 'Catch Exception '.$e->getMessage().' and rollBack this';
			$transaction->rollBack();
		}
    }
}