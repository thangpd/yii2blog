<?php
/**
 * Date: 9/23/19
 * Time: 5:22 PM
 */


$form = \yii\widgets\ActiveForm::begin();

//echo $form->field( $model, 'id' )->input( 'string', [ 'disabled' => true ] );
echo $form->field( $model, 'name' )->input( 'text', [ 'value' => $model->name ] );
//echo $form->field( $model, 'slug' )->input( 'text', [ 'slug' => $model->slug ] );
//echo $form->field( $model, 'status' )->input( 'number', [ 'value' => $model->status ] );
//echo $form->field( $model, 'status' )->widget( \kartik\switchinput\SwitchInput::classname(), [] );
//echo $form->field( $model, 'parent' )->input( 'number', [ 'value' => $model->parent ] );
$catmodel = new \backend\models\Category();
$get      = Yii::$app->request->get();
$catself  = isset( $get['id'] ) ? $get['id'] : '';
echo $form->field( $model, 'parent' )->dropDownList(
	$catmodel->getParents( $catself ), [ 'prompt' => 'Parent Menu' ]
);

echo \yii\helpers\Html::submitButton( 'Update', [ 'class' => 'btn btn-xl btn-success' ] );

\yii\widgets\ActiveForm::end();
