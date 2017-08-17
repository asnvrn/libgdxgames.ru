<?php

use yii\widgets\LinkPager;

?>

<div class="title-bar st-title-bar br-r">
    <h1>ТОР DEVELOPERS</h1>
    <div class="text-r">Рейтинг</div>
</div>
<div class="block-wrap">
    <div class="mw mw--w-xl">
        <div class="mw-head bg-red">
            <div class="mw-ic i50-dev0"></div>
            <div class="mw-txt">TOP DEVELOPERS</div>
        </div>
        <?php foreach ($models as $g) { ?>
            <a href="<?= Yii::$app->homeUrl ?>/profile/<?= $g->id ?>">
                <div class="mw-row-btn2 mw-row--br-r" style="position: relative;">
                    <?php $offset++ ?>
                    <div class="mw-num-xl"><?= $offset ?></div>
                    <div class="mw-ic-xl"><img class="mw-photo-48" src="<?= $g->photo_50 ?>"></div>
                    <div class="mw-bl3"><?= $g->dev_name ?><br><span><?= $g->first_name ?> <?= $g->last_name ?></span></div>
                    <div class="mw-bl2"><div class="mw-bl2-img i50-rat"></div></div>
                    <div class="mw-bl-rating"><?= number_format($g->rating,3) ?></div>
                </div>
            </a>
        <?php } ?>
        <div class="mw-foot2"></div>
    </div>
</div>

<?= LinkPager::widget(['pagination' => $pages,]);