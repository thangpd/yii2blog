<?php
/**
 * Date: 9/28/19
 * Time: 10:03 AM
 */


echo 'index';


echo \yii\grid\GridView::widget(
	[
		'dataProvider' => $dataProvider,

	]

);

