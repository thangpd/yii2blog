<?php

use yii\db\Migration;

/**
 * Class m190917_040724_category
 */
class m190917_040724_category extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {

	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		echo "m190917_040724_category cannot be reverted.\n";

		return false;
	}


	public function up() {
		$tableOptions = null;
		if ( $this->db->driverName === 'mysql' ) {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable( '{{%category}}', [
			'id'         => $this->primaryKey(),
			'name'       => $this->string()->notNull(),
			'slug'       => $this->string()->notNull()->unique(),
			'parent'     => $this->integer()->defaultValue( 0 ),
			'post_type'  => $this->string()->notNull()->unique(),
			'created_at' => $this->integer( 11 )->notNull(),
			'updated_at' => $this->integer( 11 )->notNull(),
		], $tableOptions );
	}

	public function down() {
		$this->dropTable( '{{%category}}' );
	}

}
