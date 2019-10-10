<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BlogModel */

$this->title                   = 'Create ' . $model->getLabelName();
$this->params['breadcrumbs'][] = [ 'label' => $model->getLabelName(), 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-create">

    <h1><?= Html::encode( $this->title ) ?></h1>

	<?= $this->render( '_form', [
		'model'    => $model,
		'category' => $category,
	] ) ?>

</div>
