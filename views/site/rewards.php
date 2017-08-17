<div class="title-bar st-title-bar br-r">
    <h1>Оцените игры</h1>
    <div class="text-r">Неоцененные игры</div>
</div>

<div class="block-wrap">
    <?php $i = 1; ?>
    <?php for($j = 0; $j < count($games); $j++) {?>

    <?php if($i%3 == 2) { ?>

    <div class="mw mw--w-center">
        <?php } else { ?>
        <div class="mw">
            <?php } ?>
            <div class="mw-head">
                <div class="mw-ic i50-gam0"></div>
                <div class="mw-txt"><?= $games[$j]['category']['name']; ?></div>
            </div>
            <div class="mw-row mw-h--sm mw-row--br-y">
                <div class="mw-txt-name"><?= $games[$j]['game_name'] ?></div>
            </div>
            <div class="mw-row-game-poster  mw-btn-gam">
                <a href="<?= Yii::$app->homeUrl ?>/game/<?= $games[$j]['id_user'] ?>/<?= $games[$j]['id_game'] ?>"><img src="https://<?= $games[$j]['game_icon'] ?>=w180"></a>
            </div>
            <div class="mw-row-end mw-h--sm mw-row--br-y">
                <div class="mw-ic-sm i32-u-rang"></div>
                <div class="mw-txt">Оценка игры</div>
                <div class="mw-txt mw-txt-r txt-yellow"><span style="font-size: 18px;"><?= number_format($games[$j]['stars'], 2) ?></span><span style="color: gray;">(<?= $games[$j]['stars_count'] ?>)</span></div>
            </div>
            <div class="mw-foot"></div>
        </div>
        <?php if($i%3 == 0) { ?>
            <div style="width: 100%; height: 10px; float: left;"></div>
        <?php } ?>

        <?php $i++; ?>
        <?php } ?>

	<?php if(count($games) == 0){ ?>
		<div  class="single-page-block-text bg-green" style="margin: 0;">
			<div style="text-align: center">
				<p style="font-size: 16px; color: white;">Нет новых игр для оценки, зайдите позже.</p>
			</div>
		</div>
    <?php } ?>
</div>