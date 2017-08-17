<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

/**
 * Class BaseController
 * @package app\controllers
 *
 * Базовый контроллер веб-приложения
 *
 */
class BaseController extends Controller
{

    public function beforeAction($action)
    {

        $this->view->title = Yii::$app->name;
        return parent::beforeAction($action);

    }
}