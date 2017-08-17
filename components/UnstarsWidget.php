<?php

namespace app\components;

use app\models\Game;
use app\models\Star;
use Yii;
use yii\base\Widget;

class UnstarsWidget extends Widget
{
    public function run()
    {
        if(!Yii::$app->user->isGuest) {
            $qq = Star::find()->select(['id_game', 'id_user'])->where(['id_user' => Yii::$app->user->id])->asArray()->all();
            $unstars_games = Game::find()->where(['not in', 'id_game', $qq])->andWhere(['!=', 'id_user', Yii::$app->user->id])->count();
            $str = $this->num2word($unstars_games);

            return $this->render('unstars', [
                'unstars_games' => $unstars_games,
                'str' => $str,
            ]);
        } else {
            return $this->render('unstars', [
                'unstars_games' => 0,
                'str' => '',
            ]);
        }

    }

    private function num2word($num)
    {
        $words = ['неоцененная игра','неоцененные игры','неоцененных игр'];
        $num = $num % 100;
        if ($num > 19) {
            $num = $num % 10;
        }
        switch ($num) {
            case 1: {
                return($words[0]);
            }
            case 2: case 3: case 4: {
            return($words[1]);
        }
            default: {
                return($words[2]);
            }
        }
    }

}