<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title                   = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
//                'id'                   => 'contact-form',
//                'method'               => 'get',
                'enableClientValidation' => true,
                'enableAjaxValidation'   => true,
                'options'                => ['class' => 'form-contact']
//                'validationUrl'        => \yii\helpers\Url::toRoute([
//                    '/site/validate-form',
//                    'scenarios' => \frontend\models\ContactForm::SCENARIO_TEST_FORM,
//                ]),
            ]); ?>

            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'subject') ?>

            <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>


            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>

<?php
$script = <<< JS

$('body').on('beforeSubmit', '.form-contact', function (e) {
    
     e.preventDefault();
    
     var form = $(this);
     // return false if form still have some validation errors
     if (form.find('.has-error').length) {
          return false;
     }
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
          }
     });
     return false;
});

JS;

$this->registerJS($script, yii\web\View::POS_END);
?>


