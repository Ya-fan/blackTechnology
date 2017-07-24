<?php

namespace app\modules\seller\controllers;

use yii\web\Controller;

/**
 * Default controller for the `web` module
 */
class DefaultController extends Controller
{

	 public $layout = "seller";
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
    	// echo 1;die;
        return $this->render('index');
    }
}
