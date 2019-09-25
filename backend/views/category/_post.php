<?php
/**
 * Date: 9/20/19
 * Time: 3:14 PM
 */

use yii\helpers\HtmlPurifier;
?>
<div class="category">
	<?php echo \yii\helpers\Html::encode( $model->name ); ?>
	<?php echo HTMLPurifier::process( $model->slug ); ?>

</div>
