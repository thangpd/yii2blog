<?php
/**
 * Date: 9/19/19
 * Time: 4:15 PM
 */

$this->params['breadcrumbs'] = [
	[ 'label' => 'Category Index', 'url' => [ 'category/index' ] ],
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
	'model' => $model,
	'attributes' => [ 'id', 'name', 'parent', 'slug', 'status', 'created_at:datetime', 'updated_at:datetime' ],
] );




