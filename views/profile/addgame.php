<div class="title-bar st-title-bar br-r">
    <h1>Добавить игру</h1>
</div>
<div class="single-page st-single-page">

    <div class="single-page-block">
        <p><b>Скопируйте и вставьте ссылку на ваше приложение в Google Play:</b></p>
        <br>
        <form action="<?= Yii::$app->homeUrl ?>/profile/addgame" enctype="multipart/form-data" method="post">
            <input type="url" name="game_url" size="60" maxlength="255" value="<?= $v ?>"
                   placeholder="Ссылка на приложение в Google Play" required>
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
            <button type="submit">Найти</button>
        </form>
    </div>
    <p><?php if (!$e && $p) { ?></p>
    <div  class="single-page-block-text" style="background-color: #ccffcc;">
        <div style="text-align: center">
            <p style="font-size: 20px"><?= $d['game_name'] ?></p>
            <p style="font-size: 16px">Разработчик: <b><?= $d['dev_name'] ?></b></p>
            <img src="https://<?= $d['game_icon'] ?>=w180">
        </div>
        <p><?= $d['game_description'] ?></p>

    </div>

    <form action="<?= Yii::$app->homeUrl ?>/profile/addgame" enctype="multipart/form-data" method="post">
        <button name="cancel" class="bt-cancel" type="submit">Отмена</button>
        <button name="add" class="bt-add" type="submit">Добавить</button>
        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
    </form>

    <?php } elseif ($e) { ?>
        <div  class="single-page-block-text" style="background-color: #e84e3e;">
            <div style="text-align: center">
                <p style="font-size: 16px; color: white;"><?= $t ?></p>
            </div>
        </div>
    <?php } ?>

</div>
