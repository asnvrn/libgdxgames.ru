<div class="title-bar st-title-bar br-r">
	<h2><?= Yii::$app->formatter->asDate($item->date, 'long') ?></h2>
	<div class="text-r">Лучшие игры</div>
</div>
<div class="wrap2block-text">

	<div class="mw mw--w-text">
		<div class="mw-head">
			<div class="mw-ic i50-news"></div>
            <div class="mw-txt"><h1><?= $item->title ?></h1></div>
		</div>
		<div class="item-poster">
			<img src="<?= $item->image ?>">
		</div>
		<div class="item-content">
            <?= $item->intro ?>
            <?= $item->content ?>
            <div id="vk_comments" style="margin-top: 20px;"></div>

            <script type="text/javascript">
                VK.Widgets.Comments("vk_comments", {limit: 10, width: "600", attach: "*"});
            </script>
		</div>
	</div>

</div>

<div class="wrap1block-r">
    <?php foreach ($best3games as $l) { ?>
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