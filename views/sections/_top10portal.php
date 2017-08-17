<div class="title-bar st-title-bar br-r">
<h2>TOP 10 портала</h2>
<div class="text-r">Лучшие из лучших</div>
</div>
<div class="block-wrap">


<div class="mw">
<div class="mw-head bg-yellow">
<div class="mw-ic i50-gam0"></div>
<div class="mw-txt">Лучшие игры</div>
</div>
    <?php $i = 0; ?>
    <?php foreach ($top10games as $g) { ?>
    <a href="<?= Yii::$app->homeUrl ?>/game/<?= $g->id_user ?>/<?= $g->id_game ?>">
    <div class="mw-row-btn mw-h--sm mw-row--br-y" style="position: relative;">
        <?php $i++ ?>
    <div class="mw-num-sm"><?= $i ?></div>
    <div class="mw-ic-sm"><img class="mw-photo-32" src="https://<?= $g->game_icon ?>=w42"></div>
    <div class="mw-txt2"><?= $g->game_name ?></div>
    <div class="p-end"></div>
    </div>
    </a>
    <?php } ?>
    <?php if ($i < 10) { ?>
        <?php for ($j = $i + 1; $j <= 10; $j++) { ?>
    <div class="mw-row-btn mw-h--sm mw-row--br-y">
    <div class="mw-num-sm"></div>
    <div class="mw-ic-sm"></div>
    <div class="mw-txt"></div>
    </div>
        <?php } ?>
    <?php } ?>
<div class="mw-foot"></div>
</div>

<div class="mw  mw--w-center">
<div class="mw-head bg-red">
<div class="mw-ic i50-dev0"></div>
<div class="mw-txt">Разработчики</div>
</div>
    <?php $i = 0; ?>
    <?php foreach ($top10devs as $d) { ?>
    <a href="/profile/<?= $d->id ?>">
    <div class="mw-row-btn mw-h--sm mw-row--br-r" style="position: relative;">
        <?php $i++ ?>
    <div class="mw-num-sm"><?= $i ?></div>
    <div class="mw-ic-sm"><img class="mw-photo-32" src="<?= $d->photo_50 ?>"></div>
    <div class="mw-txt2"><?= $d->dev_name ?></div>
    <div class="p-end"></div>
    </div>
    </a>
    <?php } ?>
    <?php if ($i < 10) { ?>
        <?php for ($j = $i + 1; $j <= 10; $j++) { ?>
    <div class="mw-row-btn mw-h--sm mw-row--br-r">
    <div class="mw-num-sm"></div>
    <div class="mw-ic-sm"></div>
    <div class="mw-txt"></div>
    </div>
        <?php } ?>
    <?php } ?>

<div class="mw-foot"></div>
</div>

	<div class="mw">
		<div class="mw-head bg-blue">
			<div class="mw-ic i50-user"></div>
			<div class="mw-txt">Активные участники</div>
		</div>
        <?php $i = 0; ?>
        <?php foreach ($top10users as $u) { ?>
			<a href="/profile/<?= $u->id ?>">
				<div class="mw-row-btn mw-h--sm mw-row--br-b" style="position: relative;">
                    <?php $i++ ?>
					<div class="mw-num-sm"><?= $i ?></div>
					<div class="mw-ic-sm"><img class="mw-photo-32" src="<?= $u->photo_50 ?>"></div>
					<div class="mw-txt2"><?= $u->first_name ?> <?= $u->last_name ?></div>
					<div class="p-end"></div>
				</div>
			</a>
        <?php } ?>
        <?php if ($i < 10) { ?>
            <?php for ($j = $i + 1; $j <= 10; $j++) { ?>
				<div class="mw-row-btn mw-h--sm mw-row--br-b">
					<div class="mw-num-sm"></div>
					<div class="mw-ic-sm"></div>
					<div class="mw-txt"></div>
				</div>
            <?php } ?>
        <?php } ?>


		<div class="mw-foot"></div>
	</div>

</div>