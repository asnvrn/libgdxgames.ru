<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    <h1><?= Html::encode($this->title) ?></h1>
	<br>
    <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
		'class' => 'btn btn-danger',
		'data' => [
			'confirm' => 'Are you sure you want to delete this item?',
			'method' => 'post',
        ],
    ]) ?>
	<br>
	<br>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'date:date',
            'intro',
            'title',
            'slug',
            'content:ntext',
            'published',
			'image',
        ],
    ]) ?>

</div>

<div class="wrap2block">

	<div class="mw mw--w-md">
		<div class="mw-head">
			<div class="mw-ic i50-news"></div>
			<div class="mw-txt"><?= $model->title ?></div>
		</div>
		<div class="news-poster">
			<img src="<?= $model->image ?>">
		</div>
		<div class="news-content">
            <?= $model->intro ?>
		</div>
		<div class="mw-row-end mw-h--sm mw-row--br-y">
			<div class="mw-ic-sm i32-activ"></div>
			<div class="mw-txt">Опубликовано</div>
			<div class="mw-txt mw-txt-r txt-yellow"><?= Yii::$app->formatter->asDate($model->date, 'long') ?></div>

		</div>

		<a href="<?= Yii::$app->homeUrl ?>/news/<?= $model->slug ?>">
		<div class="mw-foot mw-foot-btn">Подробнее</div>
		</a>
	</div>


</div>

<div class="wrap2block">

	<div class="mw mw--w-md">
		<div class="mw-head">
			<div class="mw-ic i50-news"></div>
			<div class="mw-txt"><?= $model->title ?></div>
		</div>
		<div class="news-poster">
			<img src="<?= $model->image ?>">
		</div>
		<div class="item-content">
            <?= $model->intro ?>
            <?= $model->content ?>
		</div>
		<div class="mw-row-end mw-h--sm mw-row--br-y">
			<div class="mw-ic-sm i32-activ"></div>
			<div class="mw-txt">Опубликовано</div>
			<div class="mw-txt mw-txt-r txt-yellow"><?= Yii::$app->formatter->asDate($model->date, 'long') ?></div>

		</div>

		<div class="mw-foot mw-foot-sm"></div>

	</div>


</div>
