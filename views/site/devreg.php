<div class="title-bar st-title-bar br-r">
    <h1>Заявка разработчика</h1>
</div>
<div class="single-page st-single-page">
    <div class="title-bar st-title-bar br-b">
        <h2>Правила</h2>
    </div>
    <div class="single-page-block-text">
        <p>Портал LibGDXGames предназначен, в первую очередь, для разработчиков приложений под андроид, на фреймворке
            LibGDX,
            и представляет собой рейтинговый каталог созданных приложений. Ресурс разработан специально для группы
            LibGDX
            Вконтакте, для сбора проектов участников с Google Play, дополнительной мотивации разработчиков,
            распространения и продвижения созданных приложений, проведения конкурсов и голосований, а также
            популяризации фреймворка.</p>
        <br>
        <p><b>На сайте установлены следующие правила:</b></p>
        <br>
        <p><b>1.</b> Разработчиком может стать любой авторизованный пользователь через социальную сеть Вконтакте,
            имеющий аккаунт
            разработчика на Google Play с одним сделанным и размещенным приложением.</p>
        <p><b>2.</b> Принимаются абсолютно любые приложения, созданные при помощи фреймворка LibGDX и размещенные на
            Google Play.</p>
        <p><b>3.</b> Чтобы зарегистрироваться на портале в качестве разработчика, и иметь возможность добавлять другие
            свои игры,
            достаточно указать одну полную ссылку на любое ваше приложение в Google Play.</p>
        <p><b>4.</b> Вы не можете оценивать свои приложения, а также голосовать за свои приложения.</p>
        <p><b>5.</b> К голосованиям допускаются любые авторизованные пользователи портала.</p>
        <p><b>6.</b> Рейтинги пользователей, приложений, разработчиков, а также другие оценочные показатели, носят
            мотивационно-визуальный характер и не отображают действительные способности разработчиков, реальные оценки и
            позиции приложений на Google Play.</p>
        <p><b>7.</b> Администрация сайта не несет ответственности за действия других участников и корректного
            отображения
            данных о ваших приложениях, взятых с Google Play.</p>
        <p><b>8.</b> Портал работает в автоматическом режиме, по установленным алгоритмам подсчета и отображения
            рейтингов и оценочных показателей приложений, с автоматизированными конкурсами за 5 дней до конца каждого
            месяца.</p>
        <p><b>9.</b> Администрация сайта может использовать ваши данные с Google Play по своему усмотрению, в рамках
            данного портала.</p>
        <p><b>10.</b> <span style="color: red;"><b>Запрещено</b></span> добавлять приложения чужих разработчиков, а
            также приложения, не на LibGDX.</p>
        <p>Это повлечет к немедленной блокировке аккаунта и удалению всех ваших данных!</p>
    </div>
    <div id="anchor" class="title-bar st-title-bar br-r">
        <h2>Добавить игру</h2>
    </div>

    <div class="single-page-block">
        <p><b>Скопируйте и вставьте ссылку на ваше приложение в Google Play:</b></p>
        <br>
        <form action="<?= Yii::$app->homeUrl ?>/devreg" enctype="multipart/form-data" method="post">
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

    </div>

    <form action="<?= Yii::$app->homeUrl ?>/devreg" enctype="multipart/form-data" method="post">
        <button name="cancel" class="bt-cancel" type="submit">Это не мое приложение</button>
        <button name="add" class="bt-add" type="submit">Подтвердить</button>
        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
    </form>

    <?php } elseif ($e) { ?>
        <div  class="single-page-block-text" style="background-color: #e84e3e;">
            <div style="text-align: center">
                <p style="font-size: 16px; color: white;">Приложение не найдено!</p>
            </div>
        </div>
    <?php } ?>
    <p><?php if ($p) { ?></p>
    <script>
        $(document).ready(function () {
            $('body').animate({
                scrollTop: $('#anchor').offset().top
            }, 1000);
        })
    </script>
<?php } ?>
</div>
