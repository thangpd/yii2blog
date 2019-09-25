<?php
/**
 * Date: 9/19/19
 * Time: 2:21 PM
 */

namespace backend\controllers;


use backend\models\Category;
use yii;


class CategoryController extends yii\web\Controller {


	public function actionIndex() {

		$dataProvider = new yii\data\ActiveDataProvider( [
			'query'      => Category::find(),
			'pagination' => [
				'pageSize' => 10,
			],
			'sort'       => [
				'attributes' => [ 'name', 'updated_at', 'created_at' ],
//				'defaultOrder' => [ 'name' => SORT_ASC ]
			]
		] );


		return $this->render( 'index', [ 'dataProvider' => $dataProvider ] );
	}

	public function actionUpdate() {
		$get = Yii::$app->request->get();
		if ( isset( $get['id'] ) && ! empty( $model = Category::find()->where( [ 'id' => $get['id'] ] )->limit( 1 )->one() ) ) {
			if ( ! empty( Yii::$app->request->post() ) && $model->load( $post = Yii::$app->request->post() ) ) {
				if ( $model->save() ) {
					Yii::$app->session->setFlash( 'success', 'Updated' );

					return $this->redirect( [ 'view', 'id' => $model->id ] );
				} else {
					echo '<pre>';
					print_r( $model->getErrors() );
					echo '</pre>';
				}

				return $this->redirect( [ 'view', 'id' => $this->id ] );
			}

			return $this->render( 'update', [ 'model' => $model ] );


		} else {
			Yii::$app->session->setFlash( 'error', 'Not found' );

			return $this->redirect( [ 'index', 'id' => $this->id ] );

		}
	}

	public function actionView( $id = 1 ) {
		$model = Category::findOne( $id );
		if ( empty( $model ) ) {
			throw( new yii\web\NotFoundHttpException() );
		}

		return $this->render( 'view', [ 'model' => $model ] );
	}

	public function actionCreate() {
		$model = new Category();
		$post  = Yii::$app->request->post();
		if ( $model->load( $post ) ) {
			if ( $model->save() ) {
				Yii::$app->session->setFlash( 'success', 'Save ok' );

				return $this->redirect( [ 'view', 'id' => $model->id ] );
			} else {
				echo '<pre>';
				print_r( $model->getErrors() );
				echo '</pre>';
				Yii::$app->session->setFlash( 'error', 'Save not ok' );
			}
		}

		return $this->render( 'create', [ 'model' => $model ] );
	}

	public function actionDelete() {
		if ( ! empty( $get['id'] ) ) {
			$cat = Category::findOne( $get['id'] );
			if ( ! empty( $cat ) ) {

				$cat->delete();
				Yii::$app->session->setFlash( 'success', 'Deleted id ' . $get['id'] );
				$this->redirect( [ 'category/index' ] );
			}
		} else {
			Yii::$app->session->setFlash( 'error', 'Not found id' );
			$this->redirect( [ 'category/index' ] );
		}
	}

}

