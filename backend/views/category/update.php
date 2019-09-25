<?php
/**
 * Date: 9/22/19
 * Time: 3:25 PM
 */


echo '<h1>Update Category</h1>';

$this->params['breadcrumbs'] = [
	[ 'label' => 'Category Index', 'url' => [ 'category/index' ] ],
	[ 'label' => 'Update' ]
];


/*'id'         => 'ID',
			'name'       => 'Name',
			'slug'       => 'Slug',
			'parent'     => 'Parent',
			'status'     => 'Status',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',*/


echo $this->render( '_form', [ 'model' => $model ] );


