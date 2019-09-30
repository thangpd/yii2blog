<?php
/**
 * Date: 9/27/19
 * Time: 12:17 PM
 */

namespace backend\controllers;

use backend\models\Product;
use backend\models\ProductCat;
use common\abstracts\BlogControllerAbstract;
use yii\filters\VerbFilter;

class ProductController extends BlogControllerAbstract {


	/**
	 * {@inheritdoc}
	 */
	public function behaviors() {
		return [
			'verbs' => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'delete' => [ 'POST' ],
				],
			],
		];
	}

	public function postTypeName() {
		// TODO: Implement postTypeName() method.
		return 'product';
	}


	public function getLabelName() {
		// TODO: Implement getLabelName() method.
		return 'Product';
	}

	public function getModelName() {
		return Product::class;
	}

	public function postTypeCategory() {
		// TODO: Implement postTypeCategory() method.
		return ProductCat::class;
	}






}


