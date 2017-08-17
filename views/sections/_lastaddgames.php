<div class="title-bar st-title-bar br-r">
    <h2>Новые игры</h2>
    <div class="text-r">Последние добавленные</div>
</div>

	<div class="block-wrap">

        <?php $i = 1; ?>
        <?php foreach ($lastaddgames as $l) { ?>

        <?php if($i%3 == 2) { ?>

		<div class="mw mw--w-center">
            <?php } else { ?>
			<div class="mw">
                <?php } ?>
				<div class="mw-head">
					<div class="mw-ic i50-gam0"></div>
					<div class="mw-txt"><?= $l['category']['name'] ?></div>
				</div>
				<div class="mw-row mw-h--sm">
					<div class="mw-txt-name"><?= $l['game_name'] ?></div>
				</div>
				<div class="mw-row-game-poster mw-btn-gam">
					<a href="<?= Yii::$app->homeUrl ?>/game/<?= $l['id_user'] ?>/<?= $l['id_game'] ?>"><img
							src="https://<?= $l['game_icon'] ?>=w180"></a>
				</div>
				<div class="mw-row-end mw-h--sm mw-row--br-y">
					<div class="mw-ic-sm i32-u-rang"></div>
					<div class="mw-txt">Оценка игры</div>
					<div class="mw-txt mw-txt-r txt-yellow"><span
							style="font-size: 18px;"><?= number_format($l['stars'], 2) ?></span><span
							style="color: gray;">(<?= $l['stars_count'] ?>)</span></div>

				</div>
				<div class="mw-foot"></div>
			</div>
            <?php if($i == 6) break; ?>
            <?php if($i%3 == 0) { ?>
				<div style="width: 100%; height: 10px; float: left;"></div>
            <?php } ?>

            <?php $i++; ?>
            <?php } ?>

	</div>