<?php
/**
 * Date: 9/24/19
 * Time: 4:12 PM
 */

namespace frontend\widgets;

use backend\models\BlogModel;
use yii\base\Exception;
use yii\helpers\ArrayHelper;

class BlogCardWidgets extends \yii\base\Widget {

	public $model;

	public function init() {
		parent::init(); // TODO: Change the autogenerated stub
		if ( empty( $this->model ) ) {

			throw new Exception( 'Missing model' );

		}
	}

	public function run() {
		return $this->render( 'blog', [ 'model' => $this->model ] );
	}
}