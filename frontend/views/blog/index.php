<?php
/**
 * Date: 9/24/19
 * Time: 3:34 PM
 */


$this->title                   = 'Blog';
$this->params['breadcrumbs'][] = $this->title;

$model = \backend\models\Blog::find()->all();

echo \frontend\widgets\BlogCardWidgets::widget( [ 'model' => $model ] );


?>


