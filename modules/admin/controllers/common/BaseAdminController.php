<?php 

namespace app\modules\admin\controllers\common;

use app\common\components\BaseController;

use \app\common\services\UrlService;

use \app\common\services\AppLogService;

use app\models\Admin;

/**
* admin 统一控制器当中会有一些admin独有的验证
* 
* 1: 指定特定的布局文件
* 
* 2: 进行登录验证
*/
class BaseAdminController extends BaseController
{
	// cookie_name
	protected $auth_Cookie_Name = 'super_shop_admin';

	// 白名单
	public 	  $allowAllAction = [
			'admin/user/login',
	]; 

	// 当前登录人
	public 	  $current_user = null;	

	/**
	 * 	继承 父类构造 并统一加载 布局文件
	 */
	public function __construct( $id, $modules, array $config=[] )
	{
		parent::__construct( $id, $modules, $config );
		
		// 统一继承模板布局
		$this->layout = 'admin';
	}

	/**
	 * 登录统一验证	(每次动作先执行本方法)
	 */
	public function beforeAction( $action  )
	{
		$is_login = $this->checkLoginStatus();
		

		// 验证白名单
		if( in_array( $action->getUniqueId(), $this->allowAllAction ) )
		{	
			return true;
		}

		if( !$is_login )
		{
			if( \Yii::$app->request->isAjax )
			{
				$this->renderJson( [], '请先登录', -302 );
			}
			else
			{
				$this->redirect(UrlService::buildAdminUrl( '/user/login' ) );
			}

			return false;
		}


		// 记录所有用户访问记录 日志文件写入
		AppLogService::addAppAccessLog( $this->current_user['uid'] );
		return true;
	}

	
	/**
	 * 目的:验证当前登录是否有效
	 * @return	bool 	true | false
	 */
	public function checkLoginStatus()
	{
		 $auth_Cookie = $this->getCookie( $this->auth_Cookie_Name );

		 if( !$auth_Cookie )
		 {
		 	return false;
		 }
		 
		 list( $auth_token, $uid ) = explode( '#', $auth_Cookie );

		 //验证 auth_token | uid 是否存在
		 if( !$auth_token || !$uid )
		 {
		
		 	return false;
		 }

		 // 验证$uid是否是数字
		 if( !preg_match( "/^\d+$/", $uid ) )
		 {
	
		 	return false;
		 }

		 // 验证用户信息
		 $user_info = Admin::find()->where( [ 'uid' => $uid ] )->one();

		 if( !$user_info )
		 {
	
		 	return false;
		 }

		 // 验证cookie是否真实
		 $auth_token_md5 = $this->createAuthToken( $user_info ) ;

		 if( $auth_token != $auth_token_md5 )
		 {
		 	return false;
		 }

		 // 赋值当前登录人 变量
		 $this->current_user = $user_info;

		 \Yii::$app->view->params['current_user'] = $user_info;
		 
		 return true;
	}

	// 统一生成 登录态的方法
	public function setLoginStatus( $admin_info )
	{
		$auth_token = $this->createAuthToken( $admin_info );
		
		$this->setCookie( $this->auth_Cookie_Name , $auth_token.'#'.$admin_info['uid'] );
	}	

	// 删除登录态
	public function removeLoginStatus()
	{
		$this->removeCookie( $this->auth_Cookie_Name );
	}

	// 统一生成加密字段。( 加密字符串+ ‘#’+uid, 加密字符串=MD5(login_name+login_pwd+login_salt )
	public  function createAuthToken( $admin_info )
	{
		return md5( $admin_info['login_name'].$admin_info['login_pwd'].$admin_info['login_salt'] );
	}
     
     //无限极分类
	 public function Getcate($data,$p_id = 0)
      {
        $CateData = [];
        foreach ($data as $val) {
          if ($val['p_id']==$p_id) {
            $val['Erz'] = $this->Getcate($data,$val['cate_id']);
            $CateData[] = $val;
          } 
        }
        return $CateData;
      } 

   

}

 ?>