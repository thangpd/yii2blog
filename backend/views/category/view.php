<?php
/**
 * Date: 9/19/19
 * Time: 4:15 PM
 */

$parse_request = Yii::$app->urlManager->parseRequest( Yii::$app->request );

$action_id                   = substr( $parse_request[0], 0, strpos( $parse_request[0], "/" ) );
$this->params['breadcrumbs'] = [
	[ 'label' => 'Category Index', 'url' => [ $action_id . '/index' ] ],
	[ 'label' => 'View' ]
];

echo '<h1>View Category</h1>';


echo \yii\helpers\Html::a( 'Update', [ 'category/update', 'id' => $model->id ], [ 'class' => 'btn btn-success' ] );
echo \yii\helpers\Html::a( 'Delete', [ 'category/delete', 'id' => $model->id ], [
	'class' => 'btn btn-danger',
	'data'  => [
		'confirm' => 'Sure?',
		'method'  => 'post'
	]
] );


echo \yii\widgets\DetailView::widget( [
	'model'      => $model,
	'attributes' => [ 'id', 'name', 'parent', 'slug', 'post_type', 'created_at:datetime', 'updated_at:datetime' ],
] );




