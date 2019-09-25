<?php

namespace backend\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "blog".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $content
 * @property string $image_url
 * @property int $created_at
 * @property int $updated_at
 */
class Blog extends \yii\db\ActiveRecord {
	/**
	 * {@inheritdoc}
	 */
	public static function tableName() {
		return 'blog';
	}

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
		$posts = Yii::$app->db->createCommand( 'SELECT [[slug]] FROM {{%' . self::tableName() . '}} where [[id]] <' . $id . '   ORDER BY [[id]] DESC LIMIT 1  ' )->queryAll();
		if ( ! empty( $posts ) && is_array( $posts ) ) {
			return $posts[0];

		} else {
			return false;
		}
	}

	public static function getNextBlogId( $id ) {
		$posts = Yii::$app->db->createCommand( "SELECT [[slug]] FROM {{%" . self::tableName() . "}} where [[id]] > " . $id . "  ORDER BY [[id]] LIMIT 1" )->queryAll();
		if ( ! empty( $posts ) && is_array( $posts ) ) {
			return $posts[0];
		} else {
			return false;
		}
	}


	public static function getCategoryBlog( $id = 0 ) {

		if ( $id == 0 ) {
			$model = Blog::find()->where( [ 'category' => null ] )->all();

			return $model;
		} else {
			$model = Blog::find()->where( [ 'category' => $id ] )->all();

			return $model;

		}

	}


	/**
	 * {@inheritdoc}
	 */
	public function rules() {
		return [
//			[ [ 'slug' ], 'unique' ],
			[ [ 'title' ], 'required' ],
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
			'description' => 'Description',
			'content'     => 'Content',
			'category'    => 'Category',
			'image_url'   => 'Image Url',
			'created_at'  => 'Created At',
			'updated_at'  => 'Updated At',
		];
	}

	public function getCategoryHasOne() {
		return $this->hasOne( Category::class, [ 'id' => 'category' ] );
	}
}
