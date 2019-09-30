<?php
/**
 * Date: 9/28/19
 * Time: 11:04 AM
 */

namespace common\abstracts;


use backend\models\FileUpload;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

use yii;

abstract class BlogControllerAbstract extends Controller {


	public $model;
	public $modelName;
	protected $modelCategory;
	protected $modelLableName;
	public $dataProvider;


	abstract public function getModelName();

	abstract public function postTypeName();

	abstract public function getLabelName();

	abstract public function postTypeCategory();

	public function init() {
		$this->modelName = $this->getModelName();

		$this->model = new $this->modelName();

		$this->modelLableName = $this->model->getLabelName();

		//get postTypeCategory
		$postTypeCategory    = call_user_func( [ $this->model, 'postTypeCategory' ] );
		$this->modelCategory = new $postTypeCategory;

		$query = $this->model->find()->where( [ 'post_type' => $this->postTypeName() ] );

		$this->dataProvider = new ActiveDataProvider( [
			'query'      => $query,
			'pagination' => [
				'pageSize' => 10,
			],
		] );
		parent::init(); // TODO: Change the autogenerated stub
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


		return $this->render( '@backend/views/blog/view', [
			'model' => $model,
		] );
	}

	/**
	 * Lists all Blog models.
	 * @return mixed
	 */
	public function actionIndex() {

//		$searchModel  = new BlogSearch();
//		$dataProvider = $searchModel->search( Yii::$app->request->queryParams );
		return $this->render( '@backend/views/blog/index', [
			'model'        => $this->model,
			'category'     => $this->modelCategory,
//			'searchModel'  => $searchModel,
			'dataProvider' => $this->dataProvider,
		] );
	}


	/**
	 * Creates a new Blog model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {

		$upload   = new FileUpload();
		$file_uri = $upload->uploadFile( $this->model, 'image_url' );


		if ( $this->model->load( Yii::$app->request->post() ) ) {
			if ( ! empty( $file_uri ) ) {
				$this->model->image_url = $file_uri;
			}
			if ( $this->model->save() ) {
				Yii::$app->session->addFlash( 'success', "Update succeed" );
			} else {
//				echo '<pre>';
//				print_r( $this->model->getErrors() );
//				echo '</pre>';
			}

			return $this->redirect( [ 'view', 'id' => $this->model->id ] );
		}


		return $this->render( '@backend/views/blog/create', [
			'model'    => $this->model,
			'category' => $this->modelCategory,
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

		if ( $model->load( Yii::$app->request->post() ) && $model->validate() ) {
			if ( ! empty( $file_uri ) ) {
				$model->image_url = $file_uri;
			}
			if ( $model->save() ) {
				Yii::$app->session->addFlash( 'success', "Update succeed" );
			}

			return $this->redirect( [ 'view', 'id' => $model->id ] );
		} else {
//			var_dump( $model->getErrors() );
		}

		return $this->render( '@backend/views/blog/update', [
			'model'    => $model,
			'category' => $this->modelCategory,
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
	 * @return BlogModel the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel( $id ) {
		if ( ( $model = call_user_func( [ $this->getModelName(), 'findOne' ], $id ) ) !== null ) {
			return $model;
		}

		throw new NotFoundHttpException( 'The requested page does not exist.' );
	}

	public function convertIdCategory( $model ) {
		if ( isset( $model->category ) ) {
			return $model->categoryHasOne->name;
		} else {
			return '----';
		}
	}

	public function renderIndex() {
		return yii\grid\GridView::widget( [
			'dataProvider' => $this->dataProvider,
			'columns'      => [
				[ 'class' => 'yii\grid\SerialColumn' ],
				'id',
				'title',
				'slug',
				[
					'attribute' => 'category',
					'value'     => function ( $model ) {
						return $this->convertIdCategory( $model );
					},
				],
				'description:ntext',
				'content:ntext',
				[
					'attribute' => 'image_url',
					'format'    => 'raw',
					'value'     => function ( $model ) {
						if ( isset( $model->image_url ) && ! empty( $model->image_url ) ) {
							return yii\helpers\Html::img( $model->image_url, [ 'width' => 100 ] );
						} else {
							return '';
						}
					}
				],
				'post_type',
				[ 'class' => 'yii\grid\ActionColumn' ],
			],
		] );
	}

}