<?php
/**
 * Date: 9/27/19
 * Time: 11:42 AM
 */

namespace common\abstracts;


use backend\models\Category;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii;

abstract class BlogAbtract extends \yii\db\ActiveRecord {

	abstract public function postTypeName();

	public static function tableName() {
		return 'blog'; // TODO: Change the autogenerated stub
	}

	/**
	 * {@ingeritdoc}
	 *
	 */

	public function behaviors() {
		return [
			[
				'class'      => TimestampBehavior::className(),
				'attributes' => [
					ActiveRecord::EVENT_BEFORE_INSERT => [ 'created_at', 'updated_at' ],
					ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
				],
			],
			[
				'class'         => SluggableBehavior::class,
				'attribute'     => 'title',
				'slugAttribute' => 'slug',
				'ensureUnique'  => true,
			],
		];
	}


	public static function getPreviousBlogId( $id ) {
		$posts = Yii::$app->db->createCommand( 'SELECT [[slug]] FROM {{%' . self::tableName() . '}} where [[post_type]] = " . self::postTypeName() . " and [[id]] <' . $id . '   ORDER BY [[id]] DESC LIMIT 1  ' )->queryAll();
		if ( ! empty( $posts ) && is_array( $posts ) ) {
			return $posts[0];

		} else {
			return false;
		}
	}

	public static function getNextBlogId( $id ) {
		$posts = Yii::$app->db->createCommand( "SELECT [[slug]] FROM {{%" . self::tableName() . "}} where [[post_type]] = " . self::postTypeName() . " and [[id]] > " . $id . "  ORDER BY [[id]] LIMIT 1" )->queryAll();
		if ( ! empty( $posts ) && is_array( $posts ) ) {
			return $posts[0];
		} else {
			return false;
		}
	}


	public static function getCategoryBlog( $id = 0 ) {

		if ( $id == 0 ) {
			$model = self::find()->where( [ 'category' => null ] )->all();

			return $model;
		} else {
			$model = self::find()->where( [ 'category' => $id ] )->all();

			return $model;

		}

	}


	/**
	 * {@inheritdoc}
	 */
	public function rules() {
		return [
			[ [ 'title' ], 'required' ],
			[ 'post_type', 'default', 'value' => $this->postTypeName() ],
			[ [ 'description', 'content' ], 'string' ],
			[ [ 'category', 'created_at', 'updated_at' ], 'integer' ],
			[ [ 'title' ], 'string', 'max' => 255 ],
			[ [ 'slug' ], 'string', 'max' => 100 ],
			[ [ 'image_url' ], 'file', 'extensions' => 'jpg, gif, jpeg,png' ],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels() {
		return [
			'id'          => 'ID',
			'title'       => 'Title',
			'slug'        => 'Slug',
			'post_type'   => 'Post Type',
			'description' => 'Description',
			'content'     => 'Content',
			'category'    => 'Category',
			'image_url'   => 'Image Url',
			'created_at'  => 'Created At',
			'updated_at'  => 'Updated At',
		];
	}


	function getCategoryHasOne() {
		return $this->hasOne( Category::class, [ 'id' => 'category', 'post_type' => 'post_type' ] );
	}

}