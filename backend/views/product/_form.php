<?php
/**
 * Date: 9/28/19
 * Time: 10:03 AM
 */


$form = \yii\widgets\ActiveForm::begin();

echo $form->field( $model, 'title' );
echo $form->field( $model, 'description' )->textarea();
echo $form->field( $model, 'content' )->textarea();
echo $form->field( $model, 'category' )->dropDownList( $category->getParents(), [ 'prompt' => 'Uncategory' ] );
echo $form->field( $model, 'image_url' )->fileInput( [ 'maxlength' => true ] );

if ( isset( $model->image_url ) && ! empty( $model->image_url ) ) {
	echo \yii\helpers\Html::img( $model->image_url, [ 'width' => 200 ] );
} ?>
    <div class="form-group">
		<?= \yii\helpers\Html::submitButton( 'Save', [ 'class' => 'btn btn-success' ] ) ?>
    </div>
<?php
\yii\widgets\ActiveForm::end();
