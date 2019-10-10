<?php
/**
 * Date: 9/17/19
 * Time: 4:55 PM
 */

namespace frontend\controllers;


use frontend\models\Countries;
use yii\base\Controller;
use yii\data\Pagination;

class CountryController extends Controller {

	public function actionIndex() {
		$query = Countries::find();

		$pagination = new Pagination( [ 'defaultPageSize' => 5, 'totalCount' => $query->count() ] );


		$countries = $query->orderBy( 'name' )->offset( $pagination->offset )->limit( $pagination->limit )->all();


		return $this->render( 'index', [ 'countries' => $countries, 'pagination' => $pagination ] );

	}
}