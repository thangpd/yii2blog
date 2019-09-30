<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = $model->getLabelName();
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="blog-index">

    <h1><?= Html::encode( $this->title ) ?></h1>

    <p>
		<?= Html::a( 'Create ' . $model->getLabelName(), [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
    </p>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= $this->context->renderIndex() ?>


</div>
