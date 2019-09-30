<?php
/**
 * Date: 9/28/19
 * Time: 11:57 AM
 */

namespace backend\controllers;


use backend\models\ProductCat;
use common\abstracts\CategoryControllerAbstract;
use common\abstracts\CategoryModelAbstract;
use yii;

class ProductCatController extends CategoryControllerAbstract {


	public function getModelName() {
		return ProductCat::class;
	}


	public function getLabelName() {
		// TODO: Implement getLabelName() method.
		return 'Product Category';
	}


	public function postTypeName() {
		// TODO: Implement postTypeName() method.
		return 'product';
	}
}


