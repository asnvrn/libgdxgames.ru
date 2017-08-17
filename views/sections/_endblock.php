<div class="title-bar st-title-bar br-r">
	<h2>Категории и статистика</h2>
	<div class="text-r">Конкурс</div>
</div>
<div class="block-wrap">


	<div class="mw">
		<div class="mw-head bg-green">
			<div class="mw-ic i50-gam0"></div>
			<div class="mw-txt">Категории</div>
		</div>
        <?php $i = 1; ?>
        <?php foreach ($categories as $c) { ?>
		<a>
			<div class="mw-row-btn mw-h--20 mw-row--br-g"
			">
			<div class="mw-txt-cat"><?= $c->name ?></div>
			<div class="mw-txt-cat mw-txt-r txt-yellow"><?= $count_cat[$i] ?></div>
            <?php $i++; ?>
	</div>
	</a>
    <?php } ?>
	<div class="mw-foot"></div>
	</div>

<div class="mw mw--w-center">
	<div class="mw-head">
		<div class="mw-ic i50-stat"></div>
		<div class="mw-txt">Статистика</div>
	</div>
	<div class="mw-row mw-h--sm mw-row--br-y">
		<div class="mw-ic-sm i32-gam0"></div>
		<div class="mw-txt">Игр на портале</div>
		<div class="mw-txt mw-txt-r txt-yellow"><?= $stat[0] ?></div>
	</div>
	<div class="mw-row mw-h--sm mw-row--br-b">
		<div class="mw-ic-sm i32-user"></div>
		<div class="mw-txt">Пользователей</div>
		<div class="mw-txt mw-txt-r txt-blue"><?= $stat[1] ?></div>
	</div>
	<div class="mw-row mw-h--sm mw-row--br-r">
		<div class="mw-ic-sm i32-dev0"></div>
		<div class="mw-txt">Разработчиков</div>
		<div class="mw-txt mw-txt-r txt-red"><?= $stat[2] ?></div>
	</div>
	<div class="mw-row mw-h--sm mw-row--br-y">
		<div class="mw-ic-sm i32-rew"></div>
		<div class="mw-txt">Оценок поставлено</div>
		<div class="mw-txt mw-txt-r txt-yellow"><?= $stat[3] ?></div>
	</div>
	<div class="mw-row mw-h--sm mw-row--br-d">

	</div>
	<div class="mw-row mw-h--sm mw-row--br-d">

	</div>
	<div class="mw-row mw-h--sm mw-row--br-d">

	</div>
	<div class="mw-row-end mw-h--sm mw-row--br-d" style="height: 46px; line-height: 46px;">

	</div>

	<div class="mw-foot"></div>
</div>

<div class="mw">
	<div class="mw-head bg-blue">
		<div class="mw-ic i50-cub0"></div>
		<div class="mw-txt">Конкурс</div>
	</div>
	<div class="mw-row mw-h--sm mw-row--br-b">

	</div>
	<div class="mw-row mw-h--sm mw-row--br-b">

	</div>
	<div class="mw-row mw-h--sm mw-row--br-b">

	</div>
	<div class="mw-row mw-h--sm mw-row--br-b">

	</div>
	<div class="mw-row mw-h--sm mw-row--br-b">

	</div>
	<div class="mw-row mw-h--sm mw-row--br-b">

	</div>
	<div class="mw-row mw-h--sm mw-row--br-b">

	</div>
	<div class="mw-row-end mw-h--sm mw-row--br-b" style="height: 46px; line-height: 46px;">

	</div>

	<div class="mw-foot"></div>
</div>

</div>