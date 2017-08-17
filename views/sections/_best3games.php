<div class="title-bar st-title-bar br-r">
    <h2>Лучшая игра портала</h2>
    <div class="text-r">TOP 3</div>
</div>
<div class="block-wrap">

        <?php $i=0 ?>
        <?php foreach ($top10games as $b) { ?>
        <?php if ($i == 3) break; ?>
        <?php if ($i != 1) { ?><div class="mw"><?php } else { ?><div class="mw mw--w-center"><?php } ?>
                <div class="mw-head">
                    <div class="mw-ic i50-gam<?= $i+1 ?>"></div>
                    <div class="mw-txt"><?= $i+1 ?> место</div>
                </div>
                <div class="mw-row mw-h--sm">
                    <div class="mw-txt-name"><?= $b->game_name ?></div>
                </div>
                <div class="mw-row-game-poster mw-btn-gam">
                    <a href="<?= Yii::$app->homeUrl ?>/game/<?= $b->id_user ?>/<?= $b->id_game ?>"><img
                                src="https://<?= $b->game_icon ?>=w180"></a>
                </div>
                <div class="mw-row-end mw-h--sm mw-row--br-y">
                    <div class="mw-ic-sm i32-u-rang"></div>
                    <div class="mw-txt">Оценка игры</div>
                    <div class="mw-txt mw-txt-r txt-yellow"><span
                                style="font-size: 22px;"><?= number_format($b->stars, 2) ?></span><span
                                style="color: gray;">(<?= $b->stars_count ?>)</span></div>
                </div>
                <div class="mw-foot"></div>
            </div>
            <?php $i++ ?>
            <?php } ?>



</div>
