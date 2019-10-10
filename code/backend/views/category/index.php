<?php
/**
 * Date: 9/19/19
 * Time: 2:22 PM
 */

echo '<h1>' . $label . ' Index</h1>';


$this->params['breadcrumbs'] = [
	[
		'label' => $label . ' Index',
	]
];

echo $btn_create;
echo \yii\grid\GridView::widget( [
	'dataProvider' => $dataProvider,
	'columns'      => [
		[
			'class' => 'yii\grid\SerialColumn', // <-- here
			// you may configure additional properties here
		],
		[
			'label'     => 'STT',
			'attribute' => 'id',
		],

		[
			'label'     => 'Ten',
			'attribute' => 'name',
			'value'     => function ( $data ) {
				return $data->name; // $data['name'] for array data, e.g. using SqlDataProvider.
			},
		],
		[
			'attribute' => 'slug',
			'format'    => 'text',
		],
		[
			'attribute' => 'parent',
			'format'    => 'text',
			'value'     => function ( $model, $key, $index, $column ) {
				if ( $model->parent == 0 ) {
					return '----';
				} else {
					$parent = \backend\models\Category::find()->where( [ 'id' => $model->parent ] )->one();
					if ( ! empty( $parent ) ) {
						return $parent->name;
					} else {
						return 'Unrecognized';
					}
				}
			}
		],
		'post_type',
		[
			'attribute' => 'created_at',
			'format'    => 'datetime'
		]
		,
		[
			'attribute' => 'updated_at',
			'format'    => 'datetime'
		],
		[
			'class' => 'yii\grid\ActionColumn',
		],
		[
			'class' => 'yii\grid\CheckboxColumn',
			// you may configure additional properties here
		],

	],
	'showOnEmpty'  => true,
] );


