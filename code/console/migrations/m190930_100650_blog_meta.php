<?php

use yii\db\Migration;

/**
 * Class m190930_100650_blog_meta
 */
class m190930_100650_blog_meta extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {

	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		echo "m190930_100650_blog_meta cannot be reverted.\n";

		return false;
	}

// Use up()/down() to run migration code without a transaction.
	public function up() {
		$tableOptions = null;
		if ( $this->db->driverName === 'mysql' ) {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}
		$this->createTable( '{{%blog_meta}}', [
			'id'         => $this->primaryKey(),
			'post_id'    => $this->integer( 11 ),
			'meta_key'   => $this->string( 100 ),
			'meta_value' => $this->text(),
			'created_at' => $this->integer( 11 )->notNull(),
			'updated_at' => $this->integer( 11 )->notNull(),
		], $tableOptions );

	}

	public function down() {
		$this->dropTable( '{{%blog_meta}}' );
	}
}
