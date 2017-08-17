<div class="title-bar st-title-bar br-r">
<h1><?= $game['game_name'] ?></h1>
<div class="text-r"><?= $game['category']['name'] ?></div>

</div>

<div class="wrap2block">

<div class="clearfix"></div>

    <?php if($game['game_video'] != null) { ?>
    <div class="mw-head-small"></div>
    <div class="mw-video">
        <iframe width="538" height="303" src="https://www.youtube.com/embed/<?= $game['game_video'] ?>" frameborder="0" allowfullscreen>
        </iframe>
    </div>
    <div class="mw-foot-scr"></div>
    <?php } ?>
    <div class="mw-head-small"></div>

        <div class="mw-screenshot">
            <img src="https://<?= $game['screenshot1'] ?>" />
        </div>


        <div class="mw-foot-scr"></div>

        <div class="mw-head-small"></div>
        <div class="mw-screenshot">
            <img src="https://<?= $game['screenshot2'] ?>" />
        </div>


        <div class="mw-foot-scr"></div>
	<div class="mw-head-small"></div>
	<div id="vk_comments"></div>
	<script type="text/javascript">
        VK.Widgets.Comments("vk_comments", {limit: 10, width: "538", attach: "*"});
	</script>
	<div class="mw-foot-scr"></div>
    </div>

<div class="wrap1block-r">
    <div class="mw mw--w-fl-r">
        <div class="mw-head bg-yellow">
            <div class="mw-ic i50-stat"></div>
            <div class="mw-txt">Показатели игры</div>
        </div>
        <div class="mw-row mw-h--sm mw-row--br-r">
            <div class="mw-ic-sm i32-dev0"></div>
            <div class="mw-txt">Разработчик:</div>
            <div class="mw-txt mw-txt-r txt-red"></div>
        </div>
        <a href="<?= Yii::$app->homeUrl ?>/profile/<?= $user->id ?>">
            <div class="mw-row-btn mw-h--sm mw-row--br-r" style="position: relative;">
                <div class="mw-ic-sm"><img class="mw-photo-32" src="<?= $user->photo_50 ?>"></div>
                <div class="mw-txt2 txt-red"><?= $user->dev_name ?></div>
                <div class="p-end"></div>
            </div>
        </a>
        <div class="mw-row mw-h--sm mw-row--br-b">
            <div class="mw-ic-sm i32-rat"></div>
            <div class="mw-txt">Рейтинг игры</div>
            <div class="mw-txt mw-txt-r txt-blue"><span id="_r" style="font-size: 22px;"><?= number_format($game['rating'], 3) ?></span></div>
        </div>
        <div class="mw-row mw-h--sm mw-row--br-g">
        <div class="mw-ic-sm i32-rew"></div>
        <div class="mw-txt">Оценок</div>
        <div class="mw-txt mw-txt-r txt-green"><span id="_sc" style="font-size: 16px;"><?= $game['stars_count'] ?></span></div>
        </div>
        <div class="mw-row mw-h--sm mw-row--br-y">
            <div class="mw-ic-sm i32-u-rang"></div>
            <div class="mw-txt">Оценка игры</div>
            <div class="mw-txt mw-txt-r txt-yellow"><span id="_ss" style="font-size: 22px;"><?= number_format($game['stars'], 2) ?></span></div>
        </div>


        <div class="mw-foot">

            <?php if(!Yii::$app->user->isGuest && !$isMyProfile) { ?>
            <div class="w-set-stars">
            <?php if(!$gameIsStar) { ?>



                <div class="w-set-stars-name">Оценить игру</div>

                <div class="w-set-stars-10">
                    <div id="s1" class="w-star"></div>
                    <div id="s2" class="w-star"></div>
                    <div id="s3" class="w-star"></div>
                    <div id="s4" class="w-star"></div>
                    <div id="s5" class="w-star"></div>
                    <div id="s6" class="w-star"></div>
                    <div id="s7" class="w-star"></div>
                    <div id="s8" class="w-star"></div>
                    <div id="s9" class="w-star"></div>
                    <div id="s10" class="w-star"></div>
                </div>
                <div class="w-set-stars-ok">Оценено, спасибо! ( <span id="_s"><?= $stars ?></span>/10 )</div>
<?php } else { ?>
                <div class="w-set-stars-ok">Оценено, спасибо! ( <span id="_s"><?= $stars ?></span>/10 )</div>
                <script>
                $('.w-set-stars').css('opacity', 0);
                $('.w-set-stars').css('background-color', '#14aa14');
                $('.w-set-stars').css('z-index', 10);
                $('.w-set-stars').css('display', 'block');
                $('.w-set-stars-name').css('display', 'none');
                $('.w-set-stars-10').css('display', 'none');
                $('.w-set-stars-ok').css('display', 'inline-block');
                $('.w-set-stars-ok').css('opacity', 1);
                $('.w-set-stars').css('opacity', 1);
                </script>

<?php } ?>



        </div>
        <?php } ?>
        </div>


        <a href="<?= $game['game_url'] ?>" target="_blank" class="wrap1block op mt-10">

            <div class="text">Открыть на Google Play</div>

        </a>
        <?php if($isMyProfile) { ?>
            <a href="<?= Yii::$app->homeUrl ?>/delgame/<?= $user->id ?>/<?= $game['id_game'] ?>" class="wrap1block op-del">

                <div class="text">Удалить приложение</div>

            </a>
        <?php } ?>



</div>


</div>

<script>
$(document).ready(function(){

        $('#s1').mouseover(function(){select_stars(1);});
        $('#s2').mouseover(function(){select_stars(2);});
        $('#s3').mouseover(function(){select_stars(3);});
        $('#s4').mouseover(function(){select_stars(4);});
        $('#s5').mouseover(function(){select_stars(5);});
        $('#s6').mouseover(function(){select_stars(6);});
        $('#s7').mouseover(function(){select_stars(7);});
        $('#s8').mouseover(function(){select_stars(8);});
        $('#s9').mouseover(function(){select_stars(9);});
        $('#s10').mouseover(function(){select_stars(10);});

        $('#s1').mouseleave(function(){unselect_stars(1);});
        $('#s2').mouseleave(function(){unselect_stars(2);});
        $('#s3').mouseleave(function(){unselect_stars(3);});
        $('#s4').mouseleave(function(){unselect_stars(4);});
        $('#s5').mouseleave(function(){unselect_stars(5);});
        $('#s6').mouseleave(function(){unselect_stars(6);});
        $('#s7').mouseleave(function(){unselect_stars(7);});
        $('#s8').mouseleave(function(){unselect_stars(8);});
        $('#s9').mouseleave(function(){unselect_stars(9);});
        $('#s10').mouseleave(function(){unselect_stars(10);});

        $('#s1').click(function(){click_stars(1);});
        $('#s2').click(function(){click_stars(2);});
        $('#s3').click(function(){click_stars(3);});
        $('#s4').click(function(){click_stars(4);});
        $('#s5').click(function(){click_stars(5);});
        $('#s6').click(function(){click_stars(6);});
        $('#s7').click(function(){click_stars(7);});
        $('#s8').click(function(){click_stars(8);});
        $('#s9').click(function(){click_stars(9);});
        $('#s10').click(function(){click_stars(10);});

    });

    function select_stars(n) {
        for (var i = 1; i < n+1; i++) {
            $('#s'+i).css('opacity', 1);
        }

    }

    function unselect_stars(n) {
        for (var i = 1; i < n+1; i++) {
            $('#s'+i).css('opacity', 0.3);
        }
    }

    function click_stars(n) {


        $.ajax({
        url: '<?= Yii::$app->homeUrl ?>/game/<?= $user->id ?>/<?= $game['id_game'] ?>',
        data: {s: n, _csrf: '<?=Yii::$app->request->getCsrfToken()?>'},
        type: 'POST',
        success: function(x) {
            $('.w-set-stars').css('opacity', 0);
            $('.w-set-stars').css('background-color', '#14aa14');
            $('.w-set-stars').css('z-index', 10);
            $('.w-set-stars').css('display', 'block');
            $('.w-set-stars-name').css('display', 'none');
            $('.w-set-stars-10').css('display', 'none');
            $('.w-set-stars-ok').css('display', 'inline-block');
            $('.w-set-stars-ok').animate({opacity: 1}, 200);
            $('.w-set-stars').animate({opacity: 1}, 200);

            var a = eval(x);
            var s = a.s;
            var ss = a.ss;
            var r = a.r;
            var sc = a.sc;


            $('#_s').text(s);
            $('#_ss').text(ss);
            $('#_r').text(r);
            $('#_sc').text(sc);

        },
        error: function() {
          alert('Error!');
        }
        });
    }
</script>




