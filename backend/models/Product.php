<?php
/**
 * Date: 9/27/19
 * Time: 11:37 AM
 */

namespace backend\models;


use common\abstracts\BlogAbtract;

class Product extends BlogAbtract {


	public function postTypeName() {
		// TODO: Implement postTypeName() method.
		return 'product';
	}


}