<?php
/**
 * Date: 9/19/19
 * Time: 4:15 PM
 */


?>
    <h1>Create Category</h1>

<?php


$this->params['breadcrumbs'] = [
	[
		'label' => $model->getLabelName() . ' Index',
		'url'   => [ \backend\components\ParseActionId::parseActionId() . '/index' ]
	],
	[ 'label' => 'Create' ]
];
echo $this->render( '_form', [ 'model' => $model ] );

