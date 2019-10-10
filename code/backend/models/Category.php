<?php

namespace backend\models;

use common\abstracts\CategoryModelAbstract;
use common\interfaces\PostTypeInterface;
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
class Category extends CategoryModelAbstract {
	public static $post_type = 'blog';

	public function getLabelName() {
		// TODO: Implement getLabelName() method.
		return 'Product Category';
	}

	public function postTypeName() {
		// TODO: Implement postTypeName() method.
		return 'product';
	}

	public function getDataProvider() {
		return self::find()->where( [ 'post_type' => self::$post_type ] );
	}

	public static function getParents( $self = '' ) {
		$data = self::find()->where( [
			'not in',
			'id',
			$self
		] )->andFilterWhere( [
			'post_type' => self::$post_type
		] )->all();
		if ( ! empty( $data ) ) {
			foreach ( $data as $item ) {
				$res[ $item->id ] = $item->name;
			}

			return $res;
		} else {
			return [];
		}
	}

}
