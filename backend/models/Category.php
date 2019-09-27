<?php

namespace backend\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $parent
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Category extends \yii\db\ActiveRecord {


	private $parent_cats = [];

	public function getParents( $self = '' ) {
		$data = Category::find()->where( [ 'not in', 'id', $self ] )->all();
		if ( ! empty( $data ) ) {
			foreach ( $data as $item ) {
				$this->parent_cats[ $item->id ] = $item->name;
			}

			return $this->parent_cats;
		} else {
			return [];
		}
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
			'parent'     => 'Parent',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}
}
