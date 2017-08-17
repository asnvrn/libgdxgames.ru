<?php


namespace app\controllers;

use app\components\gp\Gp;
use app\models\Game;
use app\models\User;
use Yii;

class ProfileController extends BaseController
{

    public function beforeAction($action)
    {
        return parent::beforeAction($action);
    }

    public function actionIndex($id = null)
    {
        if($id === null){
            $this->goHome();
        }

        $user = User::find()->where(['id' => $id])->limit(1)->one();

        if($user === null){
            $this->goHome();
        }

        $isMyProfile = false;

        if(!Yii::$app->user->isGuest) {
            if ($id == Yii::$app->user->id) {
                $isMyProfile = true;
            } else {
                $isMyProfile = false;
            }
        }

        $isDev = $user->is_dev;

        $games = null;
        if ($isDev) {
            $games = Game::find()->where(['id_user' => $id])->orderBy(['rating' => SORT_DESC, 'created_at' => SORT_DESC])->with('category')->asArray()->all();
        }

        $count_my_games = Game::find()->where(['id_user' => $id])->count();
        $count_all_games = Game::find()->count();

        $activ = ($user->count_stars*100)/($count_all_games - $count_my_games);

        $this->view->title = 'Профиль '.$user->first_name.' '.$user->last_name.' | '.Yii::$app->name;
        return $this->render('profile', [
            'user' => $user,
            'isGuest' => Yii::$app->user->isGuest,
            'isDev' => $isDev,
            'isMyProfile' => $isMyProfile,
            'games' => $games,
            'id' => $id,
            'stars_count' => $user->count_stars,
            'activ' => $activ,
        ]);
    }

    public function actionAddgame()
    {
        if(Yii::$app->user->isGuest){
            return $this->goHome();
        }

        $ur = User::find()->where(['id' => Yii::$app->user->id])->limit(1)->one();

        if($ur === null){
            return $this->goHome();
        }

        if(!$ur->is_dev){
            return $this->goHome();
        }

        $data = null;
        $error = false;
        $game_url = null;
        $isPost = false;
        $value = null;
        $e_text = null;

        if(isset($_POST['add'])) {

            $a= Game::addGame(
                Yii::$app->session->get('game_name'),
                Yii::$app->session->get('game_icon'),
                Yii::$app->session->get('screenshot1'),
                Yii::$app->session->get('screenshot2'),
                Yii::$app->session->get('game_type'),
                Yii::$app->session->get('game_url'),
                Yii::$app->session->get('game_video'),
                Yii::$app->session->get('dev_name')
            );

            if($a){
                Yii::$app->session->remove('game_name');
                Yii::$app->session->remove('screenshot1');
                Yii::$app->session->remove('screenshot2');
                Yii::$app->session->remove('dev_name');
                Yii::$app->session->remove('game_icon');
                Yii::$app->session->remove('game_type');
                Yii::$app->session->remove('game_video');
                $g = Game::find()->where(['game_url' => Yii::$app->session->remove('game_url')])->limit(1)->one();
                Yii::$app->session->remove('game_url');

                return Yii::$app->getResponse()->redirect(Yii::$app->homeUrl.'/game/'.Yii::$app->user->id.'/'.$g->id_game);
            }
        }

        if(isset($_POST['cancel'])) {
            Yii::$app->session->remove('game_name');
            Yii::$app->session->remove('screenshot1');
            Yii::$app->session->remove('screenshot2');
            Yii::$app->session->remove('dev_name');
            Yii::$app->session->remove('game_icon');
            Yii::$app->session->remove('game_type');
            Yii::$app->session->remove('game_url');
            Yii::$app->session->remove('game_video');
            return $this->render('addgame', ['d' => $data, 'e' => $error, 'p' => $isPost, 'v' => $value, 't' => $e_text]);
        }

        if(isset($_POST['game_url'])) {
            $game_url = Yii::$app->request->post('game_url');
            $value = $game_url;
            $isPost = true;
            if(!$data = Gp::getData($game_url)) {
                $error = true;
                $e_text = 'Приложение не найдено или неправильный адрес!';
                return $this->render('addgame', ['d' => $data, 'e' => $error, 'p' => $isPost, 'v' => $value, 't' => $e_text]);
            }
            $_data = Game::find()->where(['game_url' => $game_url])->limit(1)->one();
            if(!empty($_data)) {
                $error = true;
                $e_text = 'Приложение уже есть на сайте!';
                return $this->render('addgame', ['d' => $data, 'e' => $error, 'p' => $isPost, 'v' => $value, 't' => $e_text]);
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

        $this->view->title = 'Добавить игру | '.Yii::$app->name;

        return $this->render('addgame', ['d' => $data, 'e' => $error, 'p' => $isPost, 'v' => $value, 't' => $e_text]);
    }
}