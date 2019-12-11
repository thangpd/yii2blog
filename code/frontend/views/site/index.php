<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';

use \yii\helpers\Html;


echo 'listbox';
?>
<?= Html::listBox('fanpage', '', array('datlich', 'khongdat')) ?>
<?php echo 'radio list' ?>
<?= Html::radioList('fanpage', '', array('datlich', 'khongdat')) ?>