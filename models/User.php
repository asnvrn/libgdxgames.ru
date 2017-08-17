<?php

namespace app\models;

use app\components\MyTimestampBehavior;
use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $photo_50
 * @property string $photo_400
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password_hash
 * @property string $auth_key
 * @property integer $status
 * @property integer $dev_name
 * @property integer $is_dev
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * Один пользователь имеет много игр
     */
    public function getGames()
    {
        return $this->hasMany(Game::className(), ['id_user' => 'id']);
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

    // --- Реализация IdentityInterface ---------------------------------------------------------------------------- ///

    // Этот метод находит экземпляр identity class, используя ID пользователя.
    // Этот метод используется, когда необходимо поддерживать состояние аутентификации через сессии.
    public static function findIdentity($id)
    {
        return static::find()->where(['id' => $id])->limit(1)->one();
    }

    // Этот метод находит экземпляр identity class, используя токен доступа. Метод используется,
    // когда требуется аутентифицировать пользователя только по секретному токену (например в RESTful приложениях,
    // не сохраняющих состояние между запросами).
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    // Этот метод возвращает ID пользователя, представленного данным экземпляром identity.
    public function getId()
    {
        return $this->id;
    }

    // Этот метод возвращает ключ, используемый для основанной на cookie аутентификации. Ключ сохраняется
    // в аутентификационной cookie и позже сравнивается с версией, находящейся на сервере, чтобы удостоверится,
    // что аутентификационная cookie верная.
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    // Этот метод реализует логику проверки ключа для основанной на cookie аутентификации.
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    // --- Установка пароля ---------------------------------------------------------------------------------------- ///
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public static function setDevName($dev_name)
    {
        $u = static::find()->where(['id' => Yii::$app->user->id])->limit(1)->one();
        $u->dev_name = $dev_name;
        $u->is_dev = true;
        if($u->save()){
            return true;
        }
        return false;
    }

    public static function updateUserRating($id_user){
        // находим первую игру с максимальным рейтингом
        $max_rating = Game::find()->select(['id_user', 'rating'])->where(['id_user' => $id_user])->orderBy(['rating' => SORT_DESC, 'created_at' => SORT_DESC])->limit(1)->one();

        // Находим текущего пользователя и увеличиваем счетчик поставленных оценок
        $user_this = User::find()->select(['id','count_stars'])->where(['id' => Yii::$app->user->id])->limit(1)->one();

        $user_this->count_stars = $user_this->count_stars + 1;

        $user = User::find()->select(['id','rating'])->where(['id' => $id_user])->limit(1)->one();

        $user->rating = $max_rating->rating;

        if ($user_this->save() && $user->save()) {
            return true;
        }

        return false;
    }
}