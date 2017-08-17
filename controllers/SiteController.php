<?php

namespace app\controllers;

use app\components\gp\Gp;
use app\components\vk\Vk;
use app\models\Category;
use app\models\Game;
use app\models\Star;
use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class SiteController extends BaseController
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get', 'post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        return parent::beforeAction($action);
    }


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $top10games = Game::find()->orderBy(['rating' => SORT_DESC, 'created_at' => SORT_DESC])->limit(10)->all();
        $top10devs = User::find()->where(['is_dev' => 1])->andWhere(['>','rating',0])->orderBy(['rating' => SORT_DESC, 'created_at' => SORT_DESC])->limit(10)->all();
        $lastaddgames = Game::find()->orderBy(['created_at' => SORT_DESC])->limit(6)->with('category')->asArray()->all();
        $categories = Category::find()->all();

        $best3month[0] = Game::find()->where(['id_game' => 284])->limit(1)->one();
        $best3month[1] = Game::find()->where(['id_game' => 265])->limit(1)->one();
        $best3month[2] = Game::find()->where(['id_game' => 286])->limit(1)->one();

        $stat[0] = Game::find()->count();
        $stat[1] = User::find()->count();
        $stat[2] = User::find()->where(['is_dev' => 1])->count();
        $stat[3] = User::find()->sum('count_stars');

        $quer = 'SELECT * FROM users WHERE (users.count_stars/('.$stat[0].'-users.count_games)) > 0 ORDER BY (users.count_stars/('.$stat[0].'-users.count_games)) DESC LIMIT 10';
        $top10users = User::findBySql($quer)->all();

        $count_cat[] = null;
        for ($i = 1; $i <= 17; $i++) {
            $count_cat[$i] = Game::find()->where(['category' => $i])->with('category')->count();
        }

        $this->view->title = Yii::$app->name;
        return $this->render('index', [
            'top10games' => $top10games,
            'top10users' => $top10users,
            'top10devs' => $top10devs,
            'lastaddgames' => $lastaddgames,
            'categories' => $categories,
            'count_cat' => $count_cat,
            'stat' => $stat,
            'best3month' => $best3month,
        ]);
    }


    public function actionDevreg()
    {

        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $ur = User::find()->where(['id' => Yii::$app->user->id])->limit(1)->one();

        if ($ur->is_dev) {
            return $this->goHome();
        }

        $data = null;
        $error = false;
        $game_url = null;
        $isPost = false;
        $value = null;
        $e_text = null;

        if (isset($_POST['add'])) {
            $a = Game::addGame(
                Yii::$app->session->get('game_name'),
                Yii::$app->session->get('game_icon'),
                Yii::$app->session->get('screenshot1'),
                Yii::$app->session->get('screenshot2'),
                Yii::$app->session->get('game_type'),
                Yii::$app->session->get('game_url'),
                Yii::$app->session->get('game_video'),
                Yii::$app->session->get('dev_name')
            );

            if ($a) {
                Yii::$app->session->remove('game_name');
                Yii::$app->session->remove('screenshot1');
                Yii::$app->session->remove('screenshot2');
                Yii::$app->session->remove('dev_name');
                Yii::$app->session->remove('game_icon');
                Yii::$app->session->remove('game_type');
                Yii::$app->session->remove('game_video');
                $g = Game::find()->where(['game_url' => Yii::$app->session->remove('game_url')])->limit(1)->one();
                Yii::$app->session->remove('game_url');
                return Yii::$app->getResponse()->redirect(Yii::$app->homeUrl . '/game/' . Yii::$app->user->id . '/' . $g->id_game);
            }

        }

        if (isset($_POST['cancel'])) {
            Yii::$app->session->remove('game_name');
            Yii::$app->session->remove('screenshot1');
            Yii::$app->session->remove('screenshot2');
            Yii::$app->session->remove('dev_name');
            Yii::$app->session->remove('game_icon');
            Yii::$app->session->remove('game_type');
            Yii::$app->session->remove('game_url');
            Yii::$app->session->remove('game_video');
            return $this->render('devreg', ['d' => $data, 'e' => $error, 'p' => $isPost, 'v' => $value, 't' => $e_text]);
        }

        if (isset($_POST['game_url'])) {
            $game_url = Yii::$app->request->post('game_url');
            $value = $game_url;
            $isPost = true;
            if (!$data = Gp::getData($game_url)) {
                $error = true;
                $e_text = 'Приложение не найдено или неправильный адрес!';
                return $this->render('devreg', ['d' => $data, 'e' => $error, 'p' => $isPost, 'v' => $value, 't' => $e_text]);
            }
            $_data = Game::find()->where(['game_url' => $game_url])->limit(1)->one();
            if (!empty($_data)) {
                $error = true;
                $e_text = 'Приложение уже есть на сайте!';
                return $this->render('devreg', ['d' => $data, 'e' => $error, 'p' => $isPost, 'v' => $value, 't' => $e_text]);
            }

        }

        Yii::$app->session->set('game_name', $data['game_name']);
        Yii::$app->session->set('game_icon', $data['game_icon']);
        Yii::$app->session->set('dev_name', $data['dev_name']);
        Yii::$app->session->set('screenshot1', $data['screenshot1']);
        Yii::$app->session->set('screenshot2', $data['screenshot2']);
        Yii::$app->session->set('game_type', $data['game_type']);
        Yii::$app->session->set('game_url', $game_url);
        Yii::$app->session->set('game_video', $data['game_video']);

        $this->view->title = 'Регистрация разработчика | '.Yii::$app->name;
        return $this->render('devreg', ['d' => $data, 'e' => $error, 'p' => $isPost, 'v' => $value, 't' => $e_text]);
    }

    public function actionProfile()
    {
        return $this->goHome();
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (Yii::$app->user->isGuest) {
            $vk = Vk::instance();
            $vk->login();

            if ($vk->id_vk === null) {
                return $this->goHome();
            }

            $model = User::find()->where(['id' => $vk->id_vk])->limit(1)->one();

            if (empty($model)) {
                $user = new User();
                $user->id = $vk->id_vk;
                $user->first_name = $vk->first_name;
                $user->last_name = $vk->last_name;
                $user->photo_50 = $vk->photo_50;
                $user->photo_400 = $vk->photo_400;
                $user->setPassword('admin');

                if ($user->save()) {
                    // TODO
                }

            } else {

                if (($model->first_name != $vk->first_name) || ($model->last_name != $vk->last_name)) {
                    $model->first_name = $vk->first_name;
                    $model->last_name = $vk->last_name;

                    if ($model->save()) {
                        // TODO
                    }
                }

                if ($model->photo_50 != $vk->photo_50) {
                    $model->photo_50 = $vk->photo_50;
                    $model->photo_400 = $vk->photo_400;

                    if ($model->save()) {
                        // TODO
                    }
                }
            }

            Yii::$app->user->login(User::findOne($vk->id_vk));
        }

        return $this->goHome();
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionRules()
    {
        $this->view->title = 'Правила | '.Yii::$app->name;
        return $this->render('rules');
    }

    public function actionHelp()
    {
        $this->view->title = 'Справка | '.Yii::$app->name;
        return $this->render('help');
    }

    public function actionTopgames()
    {

        $this->view->title = 'ТОП игр LibGDXGames.ru';
        $games = Game::find()->orderBy(['rating' => SORT_DESC, 'created_at' => SORT_DESC]);

        // делаем копию выборки
        $countQuery = clone $games;
        // подключаем класс Pagination, выводим по 10 пунктов на страницу
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 25]);
        // приводим параметры в ссылке к ЧПУ
        $pages->pageSizeParam = false;
        $models = $games->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        // Передаем данные в представление
        $this->view->title = 'Лучшие игры | '.Yii::$app->name;
        return $this->render('topgames', [
            'models' => $models,
            'pages' => $pages,
            'offset' => $pages->offset,
        ]);
    }

    public function actionTopdevs()
    {
        $this->view->title = 'ТОП разработчиков LibGDXGames.ru';
        $users = User::find()->where(['is_dev' => 1])->andWhere(['>','rating',0])->orderBy(['rating' => SORT_DESC, 'created_at' => SORT_DESC]);

        // делаем копию выборки
        $countQuery = clone $users;
        // подключаем класс Pagination, выводим по 10 пунктов на страницу
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 25]);
        // приводим параметры в ссылке к ЧПУ
        $pages->pageSizeParam = false;
        $models = $users->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        // Передаем данные в представление
        $this->view->title = 'Лучшие разработчики | '.Yii::$app->name;
        return $this->render('topdevs', [
            'models' => $models,
            'pages' => $pages,
            'offset' => $pages->offset,
        ]);
    }

    public function actionRewards()
    {
        $q = Star::find()->select(['id_game', 'id_user'])->where(['id_user' => Yii::$app->user->id])->asArray()->all();

        $games = Game::find()->where(['not in', 'id_game', $q])->andWhere(['!=', 'id_user', Yii::$app->user->id])->orderBy(['created_at' => SORT_DESC])->with('category')->asArray()->all();

        //echo '<pre>'.print_r($games, true).'</pre>'; die;
        $this->view->title = 'Оценить игру | '.Yii::$app->name;
        return $this->render('rewards', [
            'games' => $games,
        ]);
    }
}