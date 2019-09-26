<?php

namespace backend\controllers;

use backend\models\FileUpload;
use Faker\Provider\File;
use Yii;
use backend\models\Blog;
use backend\models\BlogSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BlogController implements the CRUD actions for Blog model.
 */
class BlogController extends Controller {
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

	/**
	 * Lists all Blog models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel  = new BlogSearch();
		$dataProvider = $searchModel->search( Yii::$app->request->queryParams );

		return $this->render( 'index', [
			'searchModel'  => $searchModel,
			'dataProvider' => $dataProvider,
		] );
	}

	/**
	 * Displays a single Blog model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView( $id ) {
		$model = $this->findModel( $id );


		return $this->render( 'view', [
			'model' => $model,
		] );
	}

	/**
	 * Creates a new Blog model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {

		$model    = new Blog();
		$upload   = new FileUpload();
		$file_uri = $upload->uploadFile( $model, 'image_url' );


		if ( $model->load( Yii::$app->request->post() ) ) {
			if ( ! empty( $file_uri ) ) {
				$model->image_url = $file_uri;
			}
			if ( $model->save() ) {
				Yii::$app->session->addFlash( 'success', "Update succeed" );
			}

			return $this->redirect( [ 'view', 'id' => $model->id ] );
		} else {
			echo '<pre>';
			print_r( $model->getErrors() );
			echo '</pre>';
		}


		return $this->render( 'create', [
			'model' => $model,
		] );
	}

	/**
	 * Updates an existing Blog model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate( $id ) {
		$model  = $this->findModel( $id );
		$upload = new FileUpload();

		$file_uri = $upload->uploadFile( $model, 'image_url' );

		if ( $model->load( Yii::$app->request->post() ) ) {
			if ( ! empty( $file_uri ) ) {
				$model->image_url = $file_uri;
			}
			if ( $model->save() ) {
				Yii::$app->session->addFlash( 'success', "Update succeed" );
			}

			return $this->redirect( [ 'view', 'id' => $model->id ] );
		} else {
			$model->getErrors();
		}

		return $this->render( 'update', [
			'model' => $model,
		] );
	}

	/**
	 * Deletes an existing Blog model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionDelete( $id ) {
		$model = $this->findModel( $id );
		$model->delete();

		FileUpload::deleteFile( $model, 'image_url' );

		return $this->redirect( [ 'index' ] );
	}

	/**
	 * Finds the Blog model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return Blog the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel( $id ) {
		if ( ( $model = Blog::findOne( $id ) ) !== null ) {
			return $model;
		}

		throw new NotFoundHttpException( 'The requested page does not exist.' );
	}
}
