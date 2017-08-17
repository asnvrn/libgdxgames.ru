<?php

namespace app\modules\inside\controllers;

/**
 * Default controller for the `inside` module
 */
class InsideController extends BaseController
{

    public function beforeAction($action)
    {
        return parent::beforeAction($action);
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

}
