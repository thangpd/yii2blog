<?php
/**
 * Date: 9/22/19
 * Time: 3:25 PM
 */


echo '<h1>Update ' . $model->getLabelName() . '</h1>';

$parse_request = Yii::$app->urlManager->parseRequest( Yii::$app->request );

$action_id                   = substr( $parse_request[0], 0, strpos( $parse_request[0], "/" ) );
$this->params['breadcrumbs'] = [
	[ 'label' => $model->getLabelName() . ' Index', 'url' => [ $action_id . '/index' ] ],
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


