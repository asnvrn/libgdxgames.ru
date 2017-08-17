<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\components\UnstarsWidget;
use app\components\vk\Vk;
use yii\helpers\Html;
use yii\widgets\Menu;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>

    <title><?= Html::encode($this->title) ?></title>

    <meta name="description" content="ПОРТАЛ LibGDX ИГР">
    <meta name="keywords" content="LibGDX, Android, Games">

    <!--SOCIAL-->
    <meta property="og:site_name" content="libgdxgames.ru">
    <meta property="og:title" content="ПОРТАЛ LibGDX ИГР">
    <meta property="og:description" content="ПОРТАЛ LibGDX ИГР">
    <meta property="og:locale" content="ru_RU">
    <meta property="og:image" content="<?= Yii::$app->homeUrl ?>/img/icons/i200-logo">
    <!---------->

    <?php $this->head() ?>


    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="//vk.com/js/api/openapi.js?146"></script>
    <script type="text/javascript">
        VK.init({apiId: 5929489, onlyWidgets: true});
    </script>
</head>

<body>

<?php $this->beginBody() ?>

<header class="head-bar-wrap" role="banner">
    <div class="head-bar">
        <!-- head-bar -->
        <img class="site-logo" src="<?= Yii::$app->homeUrl ?>/img/icons/i50-logo.png" alt="libgdxgames.ru">
        <div class="site-title">
            <?= Html::a("Lib<span>GDX</span>Games", ['/'], ['class' => 'site-name', 'title' => 'Перейти на главную страницу', 'rel' => 'nofollow']); ?>
            <div class="site-description">Портал ваших игр на LibGDX</div>
        </div>
        <nav role="navigation">
            <?= Html::a("Новости портала", ['/news'], ['class' => 'btn-link fl-l mx-40', 'title' => 'Смотреть новости портала']); ?>
            <?= Html::a("Top<br>Games", ['/topgames'], ['class' => 'btn-link-i50 fl-l st-games', 'title' => 'Лучшие игры портала']); ?>
            <?= Html::a("Top<br>Developers", ['/topdevs'], ['class' => 'btn-link-i50 fl-l st-developers', 'title' => 'Лучшие разработчики на LibGDX']); ?>
            <?= Html::a("Справка", ['/help'], ['class' => 'btn-link fl-r', 'title' => 'Помощь по порталу']); ?>
            <?= Html::a("Правила", ['/rules'], ['class' => 'btn-link fl-r ml-10', 'title' => 'Правила портала']); ?>
        </nav>
        <?php if (Yii::$app->user->id == 24289768) { ?>
            <?= Html::a('[x]', ['/inside'], ['method' => 'post', 'rel' => 'nofollow', 'style' => 'float: right;']); ?>
        <?php } ?>
    </div>
</header>

<!--USERBAR-->
<div class="user-bar-wrap" role="menubar">
    <div class="user-bar">
        <?php if (!Yii::$app->user->isGuest) { ?>
            <!-- user-bar-in -->
            <a class="btn-group-in st-group-in" href="//vk.com/libgdxgroup" target="_blank" title="Группа LibGDX"
               rel="nofollow"></a>
            <img class="profile-img" src="<?= Yii::$app->user->identity->photo_50 ?>">
            <div
                class="profile-name"><?= Yii::$app->user->identity->first_name ?> <?= Yii::$app->user->identity->last_name ?></div>
            <menu role="button">
                <a
                    class="btn-link-i32 <?php if (Yii::$app->user->identity->is_dev) { ?>st-profile-dev<?php } else { ?>st-profile-user<?php } ?> ml-10"
                    href="<?= Yii::$app->homeUrl ?>/profile/<?= Yii::$app->user->id ?>"
                    title="Войти в свой профиль">Профиль</a>
                <a class="btn-link-i32 st-stars" href="<?= Yii::$app->homeUrl ?>/rewards"
                   title="Поставить оценки играм">Оценить</a>
                <!--                <a class="btn-link-i32 st-rewards" href="rewards" title="Посмотреть свои награды">Награды</a>-->
                <!--                <a class="btn-link-i32 st-settings" href="indev" title="Мои проекты">В разработке</a>-->
            </menu>
            <?= UnstarsWidget::widget(); ?>

            <?= Html::a('', ['/site/logout'], ['method' => 'post', 'rel' => 'nofollow', 'class' => 'btn-logout st-logout']); ?>
        <?php } else { ?>
            <!-- user-bar-out -->
            <a class="btn-group-out st-group-out" href="https://vk.com/libgdxgroup" target="_blank"
               title="Группа LibGDX">Группа LibGDX</a>
            <a class="btn-login st-login" href="<?= Vk::instance()->get_link_login() ?>" title="Войти через VK"
               rel="nofollow">Войти через</a>
        <?php } ?>
    </div>
</div>

<!--CONTENT-->
<div class="bg-wrap">


    <section class="content-wrap-text" role="main">
        <?= $content ?>
    </section>


</div>

<!--FOOTER-->
<footer class="foot-bar-wrap">
    <div class="foot-bar">
        <!--COPYRIGHT-->

            <div class="cr-bar">
                <div class="cr-bar-txt-left">&copy; <?= date('Y') ?>. Web-Appication <a href="https://libgdxgames.ru/"
                                                                                        target="_blank"
                                                                                        rel="nofollow">LibGDXGames</a>. All
                    Right
                    Received.
                </div>
                <div class="cr-bar-txt-right">. Powered By <a href="http://www.yiiframework.com/" target="_blank"
                                                              rel="external">Yii2
                        Framework</a>.
                </div>
                <div class="cr-bar-txt-right">Created By <a href="http://www.java4game.net/" target="_blank"
                                                            rel="external">JAVA4GAME</a>
                </div>
            </div>

    </div>
</footer>




<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
