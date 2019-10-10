<?php
/**
 * Date: 9/27/19
 * Time: 11:35 AM
 */

namespace backend\models;


use common\abstracts\CategoryControllerAbstract;
use common\abstracts\CategoryModelAbstract;

class ProductCat extends CategoryModelAbstract {

	public static $post_type = 'product';

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