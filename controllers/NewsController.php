<?php

namespace app\controllers;

use app\models\Game;
use app\models\News;
use Yii;
use yii\web\HttpException;

class NewsController extends BaseController
{
    public function beforeAction($action)
    {
        return parent::beforeAction($action);
    }

    public function actionIndex($id = null)
    {
        if(!empty($id)) {
            $q = htmlspecialchars($id);
            $item = News::find()->where(['slug' => $q])->limit(1)->one();
            if(!empty($item)){
                $this->view->title = $item->title.' | '.Yii::$app->name;
                $best3games = Game::find()->orderBy(['rating' => SORT_DESC, 'created_at' => SORT_DESC])->with('category')->asArray()->limit(3)->all();
                $this->layout = 'fortext';
                return $this->render('item', ['item' => $item, 'best3games' => $best3games]);
            } else {
                throw new HttpException(404, 'Страница не существует');
            }
        }

        $lastaddgames = Game::find()->orderBy(['created_at' => SORT_DESC])->limit(3)->with('category')->asArray()->all();
        $model = News::find()->where(['published' => 1])->orderBy(['date' => SORT_DESC])->limit(10)->asArray()->all();

        $this->view->title = 'Новости | '.Yii::$app->name;
        return $this->render('news', ['model' => $model, 'lastaddgames' => $lastaddgames]);
    }
}