<?php
/**
 * Date: 9/19/19
 * Time: 2:22 PM
 */

echo '<h1>Category Index</h1>';

echo \yii\helpers\Html::a( 'Create', [ 'category/create' ], [ 'class' => 'btn btn-success' ] );

$this->params['breadcrumbs'] = [
	[
		'label' => 'Category Index',
	]
];

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
		[
			'attribute' => 'status',
			'value'     => function ( $dataProvider, $key, $index, $column ) {
				if ( $dataProvider->status == 1 ) {
					return 'Active';
				} else {
					return 'Deactive';
				}
			}
		],
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


