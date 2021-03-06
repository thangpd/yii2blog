<?php
/**
 * Date: 9/27/19
 * Time: 11:37 AM
 */

namespace backend\models;


use common\abstracts\BlogModelAbtract;

class Product extends BlogModelAbtract {


	protected static $post_type = 'product';

	public function postTypeName() {
		// TODO: Implement postTypeName() method.
		return 'product';
	}

	public function getLabelName() {
		return 'Product';
		// TODO: Implement getLabelName() method.
	}

	public function postTypeCategory() {
		return ProductCat::class;
		// TODO: Implement postTypeCategory() method.
	}


	public function init() {
		self::$post_type = $this->postTypeName();

		parent::init(); // TODO: Change the autogenerated stub
	}


	public function rules() {
		$parent = parent::rules();

		return array_merge( $parent, [
			[ [ 'category' ], 'integer' ],
			[ [ 'title' ], 'string', 'max' => 255 ],
			[ [ 'slug' ], 'string', 'max' => 100 ],
			[ [ 'image_url' ], 'file', 'extensions' => 'jpg, gif, jpeg,png' ],
		] );
	}


}