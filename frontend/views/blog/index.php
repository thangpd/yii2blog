<?php
/**
 * Date: 9/24/19
 * Time: 3:34 PM
 */

use yii\widgets;
use \yii\helpers\Html;

$this->title                   = 'Blog';
$this->params['breadcrumbs'][] = $this->title;

widgets\Pjax::begin( [ 'id' => 'blog-pjax' ] );
$button = Html::a( 'List Layout', [ '' ], [ 'class' => 'btn btn-success list-view pull-right' ] ) . Html::a( 'Grid Layout', [ '' ], [ 'class' => 'btn btn-success grid-view pull-right' ] );
if ( $layout == 'listview' ) {
	echo widgets\ListView::widget( [
		'dataProvider' => $dataProvider,
		'itemView'     => '_post',
		'layout'       => '{summary}<div class="button-layout">' . $button . '</div><div class="item">{items}</div>{pager}',
		'viewParams'   => [
		]
	] );

} else {
	echo \yii\grid\GridView::widget( [
		'dataProvider' => $dataProvider,
		'layout'       => '{summary}<div class="button-layout">' . $button . '</div><div class="item">{items}</div>{pager}',
		'columns'      => [
			'title',
			'description',
			'content',
			[
				'attribute' => 'image_url',
				'value'     => function ( $model ) {
//					<div class="photo" style="background-image: url(' . $model["image_url"] . ')"></div>
					return Html::img( $model["image_url"], [ 'width' => 200 ] );
				},
				'format'    => 'raw',
			]

		]
	] );

}

widgets\Pjax::end();

$this->registerCssFile( '/css/blog-index.css', [ 'depends' => [ yii\bootstrap\BootstrapAsset::class ] ] );

$this->registerJsFile( '/js/blog-index.js', [ 'depends' => [ \yii\web\JqueryAsset::class ] ] );


?>


