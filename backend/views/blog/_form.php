<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Blog */
/* @var $form yii\widgets\ActiveForm */

$category = new \backend\models\Category();

?>

<div class="blog-form">

	<?php $form = ActiveForm::begin( [ 'options' => [ 'enctype' => 'multipart/form-data' ] ] ); ?>

	<?= $form->field( $model, 'title' )->textInput( [ 'maxlength' => true ] ) ?>


	<?= $form->field( $model, 'description' )->textarea( [ 'rows' => 6 ] ) ?>

	<?= $form->field( $model, 'content' )->textarea( [ 'rows' => 6 ] ) ?>

	<?= $form->field( $model, 'category' )->dropDownList( $category->getParents(), [ 'prompt' => 'Uncategory' ] ) ?>

	<?= $form->field( $model, 'image_url' )->fileInput( [ 'maxlength' => true ] ) ?>

	<?php if ( isset( $model->image_url ) && ! empty( $model->image_url ) ) {
		echo Html::img( $model->image_url, [ 'width' => 200 ] );
	} ?>

    <div class="form-group">
		<?= Html::submitButton( 'Save', [ 'class' => 'btn btn-success' ] ) ?>
    </div>

	<?php ActiveForm::end(); ?>

</div>
