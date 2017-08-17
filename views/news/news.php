<div class="title-bar st-title-bar br-r">
	<h1>Новости портала</h1>
	<div class="text-r">Новые игры</div>
</div>

<div class="wrap2block">
    <?php foreach ($model as $m) { ?>
		<div class="mw mw--w-md">
			<div class="mw-head">
				<div class="mw-ic i50-news"></div>
				<div class="mw-txt"><?= $m['title'] ?></div>
			</div>
			<div class="news-poster">
				<img src="<?= $m['image'] ?>">
			</div>
			<div class="news-content">
                <?= $m['intro'] ?>
			</div>
			<div class="mw-row-end mw-h--sm mw-row--br-y">
				<div class="mw-ic-sm i32-activ"></div>
				<div class="mw-txt">Опубликовано</div>
				<div class="mw-txt mw-txt-r txt-yellow"><?= Yii::$app->formatter->asDate($m['date'], 'long') ?></div>

			</div>

			<a href="<?= Yii::$app->homeUrl ?>/news/<?= $m['slug'] ?>">
				<div class="mw-foot mw-foot-btn mb-10">Подробнее</div>
			</a>
		</div>
    <?php } ?>
</div>

<div class="wrap1block-r">
    <?php foreach ($lastaddgames as $l) { ?>
		<div class="mw">
			<div class="mw-head">
				<div class="mw-ic i50-gam0"></div>
				<div class="mw-txt"><?= $l['category']['name'] ?></div>
			</div>
			<div class="mw-row mw-h--sm mw-row--br-y">
				<div class="mw-txt-name"><?= $l['game_name'] ?></div>
			</div>
			<div class="mw-row-game-poster mw-btn-gam">
				<a href="<?= Yii::$app->homeUrl ?>/game/<?= $l['id_user'] ?>/<?= $l['id_game'] ?>"><img
						src="https://<?= $l['game_icon'] ?>=w180"></a>
			</div>
			<div class="mw-row-end mw-h--sm mw-row--br-y">
				<div class="mw-ic-sm i32-rew"></div>
				<div class="mw-txt">Оценка игры</div>
				<div class="mw-txt mw-txt-r txt-yellow"><span
						style="font-size: 18px;"><?= number_format($l['stars'], 2) ?></span><span
						style="color: gray;">(<?= $l['stars_count'] ?>)</span></div>
			</div>
			<div class="mw-foot mb-10"></div>
		</div>
    <?php } ?>
</div>