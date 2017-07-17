<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;

use  app\modules\admin\controllers\common\BaseAdminController;

use app\models\Admin;
use \app\common\services\UrlService;

/**
 * 
 * Default controller for the `admin` module
 */
class UserController extends BaseAdminController
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function actionLogin()
    {
    	if(  $this->isRequestMethod( 'get' ) )
    	{
       	 return $this->renderPartial('login');	
    	}
    	else
    	{
    		$login_name = trim( $this->post( 'login_name', '' ) );
    		$login_pwd = trim( $this->post( 'login_pwd', '' ) );
    
    		if( empty( $login_name ) || empty( $login_pwd )  )
    		{
    			return $this->renderJs( '用户名或者密码有误', UrlService::buildAdminUrl( '/user/login' ) );
    		}

   			$admin_info = Admin::find()->where( ['login_name'=>$login_name ] )->one();

   			// 账号不存在
   			if( !$admin_info )
   			{
    			return $this->renderJs( '用户名或者密码有误1', UrlService::buildAdminUrl( '/user/login' ) );
   			}

   			// 校正密码
   			if( !$admin_info->verifyPassword( $login_pwd ) )
   			{
    			return $this->renderJs( '用户名或者密码有误2', UrlService::buildAdminUrl( '/user/login' ) );
   			}

   			// 设置登录态
   			$this->setLoginStatus( $admin_info );

   			$this->redirect( UrlService::buildAdminUrl( '/default/index' ) );
    	}
    }

    // 退出
    public function actionOut()
    {
 		$this->removeLoginStatus();

 		$this->redirect( UrlService::buildAdminUrl('/user/login') );
    }

	/**
	 * 管库员列表
	 * @return	bool
	 */
	public function actionList()
	{

		$data = Admin::find()->all();

		return $this->render( 'list', ['user_info' => $data ] );
	}

	/**
	 * 管理员添加/编辑
	 * @return	bool
	 */
	public function actionAdd()
	{
		return $this->renderPartial( 'add' );
	}

	/**
	 * 管理员操作
	 * @return	bool
	 */
	public function actionOps()
	{
		$id = trim( $this->post( 'uid', '') );
	
	
	}


}
