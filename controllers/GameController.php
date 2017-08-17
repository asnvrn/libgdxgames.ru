<?php

namespace app\controllers;

use app\models\Star;
use Yii;
use app\models\User;
use app\models\Game;

class GameController extends BaseController
{
    public function beforeAction($action)
    {
        return parent::beforeAction($action);
    }

    public function actionIndex($id = null, $id_game = null)
    {
        if($id === null || $id_game === null){
            return $this->goHome();
        }

        $user = User::find()->where(['id' => $id])->one();

        if(empty($user)){
            return $this->goHome();
        }

        $game = Game::find()->where(['id_game' => $id_game])->with('category')->asArray()->one();

        if(empty($game)){
            return $this->goHome();
        }

        $gameCount = Game::find()->count();

        $star = null;
        if(!Yii::$app->user->isGuest) {
            $star = Star::find()->where(['id_user' => Yii::$app->user->id, 'id_game' => $id_game])->limit(1)->one();
        }

        $gameIsStar = true;
        $stars = 0;
        if($star  === null){
            $gameIsStar = false;
        } else {
            $stars = $star->star;
        }

        $s = null;
        if(Yii::$app->request->isAjax){
            $s = Yii::$app->request->post('s');
            if(Star::setStar($id_game, $s, Yii::$app->user->id)) {
                if(Game::updateGameRating($id_game, $s)){
                    if(User::updateUserRating($id)){
                        $gm = Game::find()->where(['id_game' => $id_game])->limit(1)->one();
                        $_stars_count = $gm->stars_count;
                        $_stars = number_format($gm->stars,2);
                        $_r = number_format($gm->rating, 3);
                        return '({"s":"'.$s.'","ss":"'.$_stars.'","r":"'.$_r.'","sc":"'.$_stars_count.'"})';
                    }
                }
            } else {
                return '-';
            }
        }

        $isMyProfile = false;

        if(!Yii::$app->user->isGuest) {
            if ($id == Yii::$app->user->id) {
                $isMyProfile = true;
            } else {
                $isMyProfile = false;
            }
        }

        $this->view->title = $game['game_name'].' | '.Yii::$app->name;
        return $this->render('game', [
            'user' => $user,
            'game' => $game,
            'star' => $star,
            'stars' => $stars,
            'gameIsStar' => $gameIsStar,
            'gameCount' => $gameCount,
            'isMyProfile' => $isMyProfile,
        ]);
    }

    public function actionDelgame($id = null, $id_game = null) {

        if(Yii::$app->user->isGuest){
            return $this->goHome();
        }

        if($id === null || $id_game === null){
            return $this->goHome();
        }

        $user = User::find()->where(['id' => $id])->one();

        if($user === null){
            return $this->goHome();
        }

        if($id != Yii::$app->user->id){
            return $this->goHome();
        }

        $game = Game::find()->where(['id_game' => $id_game])->one();

        if($game === null){
            $this->goHome();
        }

        if(Game::deleteGame($id_game)) {
            return Yii::$app->getResponse()->redirect(Yii::$app->homeUrl.'/profile/'.Yii::$app->user->id);
        };
    }
}