<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Blogs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-index">

    <h1><?= Html::encode( $this->title ) ?></h1>

    <p>
		<?= Html::a( 'Create Blog', [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
    </p>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= GridView::widget( [
		'dataProvider' => $dataProvider,
		'filterModel'  => $searchModel,
		'columns'      => [
			[ 'class' => 'yii\grid\SerialColumn' ],

			'id',
			'title',
			'slug',
			[
				'attribute' => 'category',
				'value'     => function ( $model ) {
					$cat = \backend\models\Category::findOne( $model->category );
					if ( ! empty( $cat ) ) {
						return $cat->name;

					} else {
						return "---";
					}

				}
			],
			'description:ntext',
			'content:ntext',
			[
				'attribute' => 'image_url',
				'format'    => 'raw',
				'value'     => function ( $model ) {
					if ( isset( $model->image_url ) && ! empty( $model->image_url ) ) {
						return Html::img( $model->image_url, [ 'width' => 100 ] );
					} else {
						return '';
					}
				}
			],
			//'created_at',
			//'updated_at',

			[ 'class' => 'yii\grid\ActionColumn' ],
		],
	] ); ?>


</div>
