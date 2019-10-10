<?php
/**
 * Date: 9/19/19
 * Time: 2:21 PM
 */

namespace backend\controllers;


use backend\models\Category;
use common\abstracts\CategoryControllerAbstract;
use yii;


class CategoryController extends CategoryControllerAbstract {


	public function actionIndex() {
		$label_name = $this->getLabelName();

		$btn_create = \yii\helpers\Html::a( 'Create', [ Yii::$app->parseActionId->parseActionId(). '/create' ], [ 'class' => 'btn btn-success' ] );


		return $this->render( '@backend/views/category/index',
			[
				'model'        => $this->model,
				'dataProvider' => $this->dataProvider,
				'btn_create'   => $btn_create,
				'label'        => $label_name,
			] );
	}

	function actionCreate() {
		$post      = Yii::$app->request->post();
		$action_id = Yii::$app->parseActionId->parseActionId();

		if ( $this->model->load( $post ) ) {
			if ( $this->model->save() ) {
				Yii::$app->session->setFlash( 'success', 'Save ok' );


				return $this->redirect( [ $action_id . '/view', 'id' => $this->model->id ] );
			} else {
				Yii::$app->session->setFlash( 'error', 'Save not ok' );
			}
		}
		$this->params['breadcrumbs'] = [
			[ 'label' => 'Category Index', 'url' => [ $action_id . '/index' ] ],
			[ 'label' => 'Create' ]
		];

		return $this->render( '@backend/views/category/create', [
			'model' => $this->model,
		] );
	}

	public function actionUpdate( $id = 0 ) {


		$this->render( '@backend/views/category/update', [ 'model' => $this->model ] );
	}

	public function actionDelete( $id = 0 ) {
		$get           = Yii::$app->request->get();
		$parse_request = Yii::$app->urlManager->parseRequest( Yii::$app->request );
		if ( strpos( $parse_request[0], "/" ) ) {
			$strpos = strpos( $parse_request[0], "/" );
		} else {
			$strpos = strlen( $parse_request[0] );
		}
		$action_id = substr( $parse_request[0], 0, $strpos );


		if ( ! empty( $get['id'] ) ) {
			$cat = call_user_func( [ $this->getModelName(), 'findOne' ], $id );
			if ( ! empty( $cat ) ) {

				$cat->delete();
				Yii::$app->session->setFlash( 'success', 'Deleted id ' . $get['id'] );
				$this->redirect( [ Yii::$app->parseActionId->parseActionId() . "/index" ] );
			}
		} else {
			Yii::$app->session->setFlash( 'error', 'Not found id' );
			$this->redirect( [ Yii::$app->parseActionId->parseActionId() . "/index" ] );
		}

	}


	public function getLabelName() {
		return 'Category';
		// TODO: Implement getLabelName() method.
	}

	public function getModelName() {
		return Category::class;
	}

	public function postTypeName() {
		// TODO: Implement postTypeName() method.
		return 'category';
	}
}

