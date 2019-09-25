<?php
/**
 * Date: 9/17/19
 * Time: 3:07 PM
 */

use yii\helpers\Html;


$form = \yii\widgets\ActiveForm::begin();
?>
<?= $form->field( $model, 'name' ) ?>
<?= $form->field( $model, 'email' ) ?>

<div class="form-group">
	<?= Html::submitButton( 'Submit', [ 'class' => 'btn btn-primary' ] ); ?>

</div>


<?php \yii\widgets\ActiveForm::end(); ?>













