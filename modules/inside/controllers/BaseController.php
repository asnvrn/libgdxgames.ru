<?php

namespace app\modules\inside\controllers;

use Yii;
use yii\web\Controller;

class BaseController extends Controller
{
    /** Метод выполняется первым в приложении */
    public function beforeAction($action)
    {

        if(Yii::$app->user->id != 24289768) {
            return $this->goHome();
        }
        $this->view->title = 'Admin Panel | '.Yii::$app->name;
        return parent::beforeAction($action);

    }
}