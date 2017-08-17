<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php if(empty($model->date)) {
		$d = date('d.m.Y');
    } else {
        $d = date('d.m.Y', $model->date);
    } ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput(['value' => $d]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'intro')->textarea(['rows' => 4, 'maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 10]) ?>

    <?= $form->field($model, 'published')->checkbox() ?>

	<?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
