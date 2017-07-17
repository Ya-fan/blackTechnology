<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use  app\modules\admin\controllers\common\BaseAdminController;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends BaseAdminController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $layout = "admin";
    
    public function actionIndex()
    {


        return $this->render('index');
    }
}
