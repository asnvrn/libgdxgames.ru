<div class="title-bar st-title-bar br-r">
    <?php if($isMyProfile) { ?>
        <h1>Мой профиль</h1>
    <?php } else { ?>
        <h1>Профиль</h1>
    <?php } ?>

</div>

<div class="block-wrap">

    <div class="mw">
        <div class="mw-head <?php if($isDev) { ?>bg-red<?php } else { ?>bg-blue<?php } ?>" style="border-bottom: none;">
            <div class="mw-ic <?php if($isDev) { ?>i50-dev0<?php } else { ?>i50-user<?php } ?>"></div>
            <div class="mw-txt"><?php if($isDev) { ?>Разработчик<?php } else { ?>Пользователь<?php } ?></div>
        </div>

        <div class="mw-row264">
            <img class="mw-photo-400" src="<?= $user->photo_400 ?>">
        </div>


        <?php if($isMyProfile && !$isDev) { ?>
            <a href="<?= Yii::$app->homeUrl ?>/devreg">
                <div class="mw-row-btn mw-h--sm mw-row--br-r">
                    <div class="mw-txt-name">Стать разработчиком</div>
                </div>
            </a>
        <?php } ?>
        <?php if($isDev) { ?>
            <div class="mw-row-end mw-h--sm">
                <div class="mw-txt-name"><?= $user->first_name.' '.$user->last_name ?></div>
            </div>
        <?php } else { ?>
            <?php if(!$isMyProfile) { ?>
                <div class="mw-row-end mw-h--sm">
                    <div class="mw-txt-name"><?= $user->first_name.' '.$user->last_name ?></div>
                </div>
            <?php } ?>
        <?php } ?>
        <div class="mw-row mw-h--sm mw-row--br-b">
            <div class="mw-ic-sm i32-rat"></div>
            <div class="mw-txt">Рейтинг</div>
            <div class="mw-txt mw-txt-r txt-blue">
                <?php if($isDev) { ?>
				<span style="font-size: 16px;"><?= number_format($user->rating, 3) ?></span>
                <?php } else { ?>
					<span style="color: grey;">Недоступно</span>
                <?php } ?>
			</div>
        </div>
		<div class="mw-row mw-h--sm mw-row--br-g">
			<div class="mw-ic-sm i32-activ"></div>
			<div class="mw-txt">Активность</div>
			<div class="mw-txt mw-txt-r txt-green"><span style="font-size: 16px;"><?= number_format($activ,0) ?>%</span></div>
		</div>
        <div class="mw-row mw-h--sm mw-row--br-y">
            <div class="mw-ic-sm i32-rew"></div>
            <div class="mw-txt">Оценено игр</div>
            <div class="mw-txt mw-txt-r txt-yellow"><span style="font-size: 16px;"><?= $stars_count ?></span></div>
        </div>
        <?php if($isMyProfile && $isDev) { ?>
            <a href="/profile/addgame"><div class="mw-foot-href">Добавить игру</div></a>
        <?php } else { ?>
            <div class="mw-foot"></div>
        <?php } ?>

    </div>

    <?php if($isDev) { ?><div class="bar-in-profile bg-red"><?php } else { ?><div class="bar-in-profile bg-blue"><?php } ?>
        <div class="text"><?php if($isDev) { ?><?= $user->dev_name ?><?php } else { ?><?= $user->first_name ?> <?= $user->last_name ?><?php } ?></div>
    </div>

    <div class="infobox-in-profile">
		Информация недоступна.
    </div>

    <div class="bar-in-profile-bottom">
        <div class="text"></div>
    </div>

</div>

<?php if($isDev) { ?>

    <div class="title-bar st-title-bar br-r">
        <?php if($isMyProfile) { ?><h2>Мои игры</h2><?php } else { ?><h2>Игры разработчика</h2><?php } ?>
		<div class="text-r">По рейтингу</div>
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
                    <div class="mw-row mw-h--sm">
                        <div class="mw-txt-name"><?= $games[$j]['game_name'] ?></div>
                    </div>
            <div class="mw-row-game-poster mw-btn-gam">
                <a href="/game/<?= $id ?>/<?= $games[$j]['id_game'] ?>"><img src="https://<?= $games[$j]['game_icon'] ?>=w180"></a>
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

</div>

<?php } ?>