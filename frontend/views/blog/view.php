<?php
/**
 * Date: 9/24/19
 * Time: 5:06 PM
 */
$this->title                   = $model->title;
$this->params['breadcrumbs'][] = [ 'label' => 'Blogs', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;

echo \yii\widgets\DetailView::widget( [
	'model'      => $model,
	'attributes' => [
		'title',                                           // title attribute (in plain text)
		'description:html',                                // description attribute formatted as HTML
		'content:html',                                // description attribute formatted as HTML
		[
			'attribute' => 'image_url',
			'value'     => function ( $model ) {
				return \yii\helpers\Html::img( $model->image_url, [ 'width' => 200 ] );
			},
			'format'    => 'raw'
		],
		[
			'attribute' => 'category',
			'value'     => function ( $model ) {
				if ( empty( $model->category ) ) {
					return \yii\helpers\Html::a( 'Uncategory', \yii\helpers\Url::to( [ 'blog/category' ] ) );
				} else {
					return \yii\helpers\Html::a( $model->categoryHasOne->name, \yii\helpers\Url::to( [
						'blog/category',
						'id' => $model->category
					] ) );

				}
			},
			'format'    => 'raw',
		]
	],
] );

$next_blog_id = \backend\models\BlogModel::getNextBlogId( $model->id );
$prev_blog_id = \backend\models\BlogModel::getPreviousBlogId( $model->id );

if ( $prev_blog_id ) {
	echo \yii\helpers\Html::a( 'Previous Blog', [
		'blog/view',
		'slug' => $prev_blog_id['slug']
	], [ 'class' => 'pull-left' ] );
}

if ( $next_blog_id ) {
	echo \yii\helpers\Html::a( 'Next Blog',
		[ 'blog/view', 'slug' => $next_blog_id['slug'] ],
		[ 'class' => 'pull-right' ] );
}



