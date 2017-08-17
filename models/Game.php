<?php

namespace app\models;

use app\components\MyTimestampBehavior;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "games".
 *
 * @property integer $id_game
 * @property integer $id_user
 * @property string $game_name
 * @property string $game_icon
 * @property string $screenshot1
 * @property string $screenshot2
 * @property double $stars
 * @property integer $stars_count
 * @property string $game_url
 * @property integer $created_at
 * @property integer $category
 * @property integer count_games
 * @property string $game_video
 */
class Game extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%games}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id_category' => 'category']);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            MyTimestampBehavior::className(),
        ];
    }

    public static function addGame($game_name, $game_icon, $screenshot1, $screenshot2, $game_type, $game_url, $game_video, $dev_name)
    {

        $game = new Game();

        $game->game_name = $game_name;
        $game->game_icon = $game_icon;
        $game->screenshot1 = $screenshot1;
        $game->screenshot2 = $screenshot2;
        $game->category = $game_type;
        $game->game_url = $game_url;


        $game->game_video = $game_video;
        $game->id_user = Yii::$app->user->id;

        $dev = User::findOne(Yii::$app->user->id);
        $dev->count_games = $dev->count_games + 1;

        //if (!$dev->is_dev) {
            $dev->dev_name = $dev_name;
            $dev->is_dev = true;
            if (!$dev->save()) {
                return false;
            }
        //}
        $dev->dev_name = $dev_name;
        $dev->is_dev = true;

        if ($game->save()) {
            return true;
        }

        return false;

    }

    public static function deleteGame($id_game)
    {
        $game = self::findOne($id_game);

        if ($game->delete()) {

        }

        $ss = Star::find()->select(['id_game', 'id_user'])->where(['id_game' => $id_game])->all();

        $arr = [];
        foreach ($ss as $s) {
            $arr[] = $s->id_user;
        }

        $uu = User::find()->select(['id', 'count_stars'])->where(['in', 'id', $arr])->all();
        foreach ($uu as $u) {
            $u->count_stars = $u->count_stars - 1;

            $u->save();
        }

        Star::deleteAll(['id_game' => $id_game]);

        $sum_user_games_rating = Game::find()->where(['id_user' => Yii::$app->user->id])->sum('rating');
        $user = User::find()->select(['id', 'rating', 'count_games'])->where(['id' => Yii::$app->user->id])->limit(1)->one();
        $g_count = Game::find()->where(['id_user' => Yii::$app->user->id])->count();
        $user->count_games = $user->count_games - 1;

        if($g_count == 0 || empty($g_count)){
            $user->rating = 0;
        } else {
            $user->rating = $sum_user_games_rating / $g_count;
        }

        if ($user->save()) {
            return true;
        }


    }

    public static function updateGameRating($id_game, $new_star)
    {
        // Находим игру в базе
        $game = Game::find()->where(['id_game' => $id_game])->limit(1)->one();

        // Увеличиваем счетчик оценок на 1
        $_stars_count = $game->stars_count + 1;

        // Прибавляем к сумме оценок новую оценку
        $_sum_stars = $game->sum_stars + $new_star;

        // Вычисляем новую среднюю оценку
        $_stars = $_sum_stars / $_stars_count;

        // Вычисляем новый рейтинг игры
        $_rating = self::wilson_score($_sum_stars, $_stars_count);

        // Присваиваем новые значения игре
        $game->stars = $_stars;
        $game->sum_stars = $_sum_stars;
        $game->stars_count = $_stars_count;
        $game->rating = $_rating;

        if ($game->save()) {
            return true;
        }

        return false;
    }


    /**
     * @param $sum_rating - сумма всех оценок
     * @param $n - количество оценок
     * @param array $votes_range - диапазон
     *
     * @return float - готовый рейтинг
     *
     * Метод расчета рейтинга
     */
    public static function wilson_score($sum_rating, $n, $votes_range = [1, 10])
    {
        $z = 1.64485;
        $v_min = min($votes_range);
        $v_width = (float)(max($votes_range) - $v_min);
        $phat = ($sum_rating - $n * $v_min) / $v_width / (float)($n);
        $rating = ($phat + $z * $z / (2 * $n) - $z * sqrt(($phat * (1 - $phat) + $z * $z / (4 * $n)) / $n)) / (1 + $z * $z / $n);
        return $rating * $v_width + $v_min;
    }
}
