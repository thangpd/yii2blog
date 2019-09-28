<?php
/**
 * Date: 9/27/19
 * Time: 11:35 AM
 */

namespace backend\models;


use common\abstracts\CategoryAbstract;

class ProductCategory extends CategoryAbstract {

	function postTypeName() {
		// TODO: Implement postTypeName() method.
		return 'blog';
	}
}