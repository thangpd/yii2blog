<?php

use yii\db\Migration;

/**
 * Class m190923_083006_blog
 */
class m190923_083006_blog extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {

	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		echo "m190923_083006_blog cannot be reverted.\n";

		return false;
	}

	// Use up()/down() to run migration code without a transaction.
	public function up() {
		$tableOptions = null;
		if ( $this->db->driverName === 'mysql' ) {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}
		$this->createTable( '{{%blog}}', [
			'id'          => $this->primaryKey(),
			'title'       => $this->string()->notNull(),
			'slug'        => $this->string( 100 )->unique(),
			'description' => $this->text(),
			'content'     => $this->text(),
			'image_url'   => $this->string(),
			'category'    => $this->integer()->defaultValue( 0 ),
			'post_type'   => $this->string()->notNull(),
			'created_at'  => $this->integer( 11 )->notNull(),
			'updated_at'  => $this->integer( 11 )->notNull(),
		], $tableOptions );

	}

	public function down() {
		$this->dropTable( '{{%blog}}' );
	}
}
