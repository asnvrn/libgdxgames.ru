<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "stars".
 *
 * @property integer $id_user
 * @property integer $id_game
 * @property integer $star
 */
class Star extends ActiveRecord
{
    /**
     * Таблица всех оценок - stars
     */
    public static function tableName()
    {
        return '{{%stars}}';
    }

    public static function setStar($id_game, $new_star, $id_user)
    {
        // Пробуем найти существующую оценку
        $_star = Star::find()->where(['id_game' => $id_game])->andWhere(['id_user' => $id_user])->limit(1)->one();

        // Проверяем, поставлена ли уже оценка
        if (!empty($_star)) {
            return false; // Оценка поставлена, выходим из метода
        }

        // Оценки нет, создаем новую оценку
        $star = new Star();
        $star->id_game = $id_game;
        $star->star = $new_star;
        $star->id_user = $id_user;

        if ($star->save()) {
            return true;
        }
        return false;
    }
}
