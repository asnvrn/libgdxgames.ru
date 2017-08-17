<?php

use yii\widgets\LinkPager;

?>

<div class="title-bar st-title-bar br-r">
    <h1>TOP GAMES</h1>
    <div class="text-r">Рейтинг</div>
</div>
<div class="block-wrap">
    <div class="mw mw--w-xl">
        <div class="mw-head bg-yellow">
            <div class="mw-ic i50-gam0"></div>
            <div class="mw-txt">TOP GAMES</div>
        </div>
        <?php foreach ($models as $g) { ?>
            <a href="<?= Yii::$app->homeUrl ?>/game/<?= $g->id_user ?>/<?= $g->id_game ?>">
                <div class="mw-row-btn2 mw-row--br-y" style="position: relative;">
                    <?php $offset++ ?>
                    <div class="mw-num-xl"><?= $offset ?></div>
                    <div class="mw-ic-xl"><img class="mw-photo-48" src="https://<?= $g->game_icon ?>=w48"></div>
                    <div class="mw-bl1"><?= $g->game_name ?></div>
                    <div class="mw-bl2"><div class="mw-bl2-img i50-star"></div></div>
					<?php if(number_format($g->stars,2) != 10.00) { ?>
                    <div class="mw-bl-stars"><?= number_format($g->stars,2) ?></div>
					<?php } else { ?>
					<div class="mw-bl-stars">10.0</div>
					<?php } ?>
                    <div class="mw-bl2"><div class="mw-bl2-img i50-rat"></div></div>
                    <div class="mw-bl-rating"><?= number_format($g->rating,3) ?></div>
                </div>
            </a>
        <?php } ?>
        <div class="mw-foot2"></div>
    </div>
</div>

<?= LinkPager::widget(['pagination' => $pages,]);