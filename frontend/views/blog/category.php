<?php
/**
 * Date: 9/25/19
 * Time: 12:19 AM
 */


$this->title                   = $cat_model->name;
$this->params['breadcrumbs'][] = [ 'label' => 'Blogs', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;


echo \frontend\widgets\BlogCardWidgets::widget( [ 'model' => $blog_model ] );

