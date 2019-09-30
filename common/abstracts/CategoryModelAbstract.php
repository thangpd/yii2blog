<?php
/**
 * Date: 9/27/19
 * Time: 12:02 PM
 */

namespace common\abstracts;


use backend\models\Category;
use common\interfaces\PostTypeInterface;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

abstract class CategoryModelAbstract extends ActiveRecord {

	protected static $post_type = '';


	abstract public function getDataProvider();

	abstract public function getLabelName();

	public function postTypeName() {
		return self::$post_type;
	}


	public function behaviors() {
		return [
			[
				'class'      => TimestampBehavior::className(),
				'attributes' => [
					ActiveRecord::EVENT_BEFORE_INSERT => [ 'updated_at', 'created_at' ],
					ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
				]
			],
			[
				'class'        => SluggableBehavior::className(),
				'attribute'    => 'name',
				'ensureUnique' => true,
			]
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public static function tableName() {
		return 'category';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules() {
		return [
			[ [ 'name', ], 'required' ],
			[ [ 'parent' ], 'integer' ],
			[ 'post_type', 'default', 'value' => $this->postTypeName() ],
			[ [ 'created_at', 'updated_at' ], 'safe' ],
			[ [ 'name', 'slug' ], 'string', 'max' => 255 ],
			[ [ 'slug' ], 'unique' ],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels() {
		return [
			'id'         => 'ID',
			'name'       => 'Name',
			'slug'       => 'Slug',
			'post_type'  => 'Post Type',
			'parent'     => 'Parent',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}


}