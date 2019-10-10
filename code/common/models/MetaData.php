<?php
/**
 * Date: 9/30/19
 * Time: 5:20 PM
 */

namespace common\models;


use yii\db\ActiveRecord;

class MetaData extends ActiveRecord {


	public function rules() {
		return [
			[ [ 'post_id', 'meta_key' ], 'required' ],
			[ 'post_id', 'integer' ],
			[ 'meta_key', 'trim' ],
			[ 'meta_key', 'string' ],
			[ 'meta_value', 'safe' ],
		];
	}


}