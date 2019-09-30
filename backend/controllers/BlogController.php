<?php

namespace backend\controllers;

use backend\models\Category;
use backend\models\FileUpload;
use common\abstracts\BlogControllerAbstract;
use Yii;
use backend\models\BlogModel;
use backend\models\BlogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BlogController implements the CRUD actions for Blog model.
 */
class BlogController extends BlogControllerAbstract {
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

	public function getLabelName() {
		return 'Blog';
		// TODO: Implement getLabelName() method.
	}

	public function getModelName() {
		return BlogModel::class;
		// TODO: Implement getModelName() method.
	}

	public function postTypeCategory() {
		return Category::class;
		// TODO: Implement postTypeCategory() method.
	}


	public function postTypeName() {
		return 'blog';
		// TODO: Implement postTypeName() method.
	}
}
