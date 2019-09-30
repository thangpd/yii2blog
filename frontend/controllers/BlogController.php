<?php
/**
 * Date: 9/24/19
 * Time: 3:33 PM
 */

namespace frontend\controllers;


use backend\models\BlogModel;
use backend\models\Category;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class BlogController extends Controller {

	public function actionIndex() {


		$dataProvider = new ActiveDataProvider( [
			'query'      => BlogModel::find(),
			'pagination' => [
				'pageSize' => 5,
			],
		] );
		$get          = \Yii::$app->request->get();
		$layout       = 'listview';
		if ( isset( $get['layout'] ) ) {
			$layout = $get['layout'];
		}

		return $this->render( 'index', [ 'dataProvider' => $dataProvider, 'layout' => $layout ] );
	}

	public function actionView() {
		$get = \Yii::$app->request->get();
		if ( ! isset( $get['slug'] ) && empty( $get['slug'] ) ) {
			\Yii::$app->session->addFlash( 'error', 'Not found slug' );

			return $this->redirect( [ 'index' ] );
		}


		$model = BlogModel::find()->where( [ 'slug' => $get['slug'] ] )->limit( 1 )->one();

		return $this->render( 'view', [ 'model' => $model ] );
	}

	public function actionCategory( $id = 0 ) {
		$blog_model = BlogModel::getCategoryBlog( $id );
		$cat_model  = Category::find( $id )->limit( 1 )->one();

		return $this->render( 'category', [ 'blog_model' => $blog_model, 'cat_model' => $cat_model ] );

	}


}